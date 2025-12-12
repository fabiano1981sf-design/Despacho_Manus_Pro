<?php

namespace App;

/**
 * Classe Auth
 * Gerencia autenticação e autorização de usuários
 */
class Auth {
    
    /**
     * Realiza o login do usuário
     * 
     * @param string $email
     * @param string $password
     * @return array
     */
    public static function login(string $email, string $password): array {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Email e senha são obrigatórios.'];
        }
        
        $sql = "SELECT id, nome, email, senha_hash, role FROM users WHERE email = ?";
        $user = Database::fetchOne($sql, [$email]);
        
        if (!$user || !password_verify($password, $user['senha_hash'])) {
            return ['success' => false, 'message' => 'Credenciais inválidas.'];
        }
        
        // Regenera o ID da sessão para evitar fixação de sessão
        session_regenerate_id(true);
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        
        return ['success' => true, 'message' => 'Login realizado com sucesso!'];
    }
    
    /**
     * Verifica se o usuário está logado
     * 
     * @return bool
     */
    public static function isLoggedIn(): bool {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    /**
     * Realiza o logout do usuário
     */
    public static function logout(): void {
        session_destroy();
        session_start();
    }
    
    /**
     * Obtém o usuário atualmente logado
     * 
     * @return array|null
     */
    public static function user(): ?array {
        if (!self::isLoggedIn()) {
            return null;
        }
        
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role'],
        ];
    }
    
    /**
     * Obtém o ID do usuário logado
     * 
     * @return int|null
     */
    public static function id(): ?int {
        return $_SESSION['user_id'] ?? null;
    }
    
    /**
     * Obtém o nome do usuário logado
     * 
     * @return string|null
     */
    public static function name(): ?string {
        return $_SESSION['user_name'] ?? null;
    }
    
    /**
     * Obtém o email do usuário logado
     * 
     * @return string|null
     */
    public static function email(): ?string {
        return $_SESSION['user_email'] ?? null;
    }
    
    /**
     * Obtém a role do usuário logado
     * 
     * @return string|null
     */
    public static function role(): ?string {
        return $_SESSION['user_role'] ?? null;
    }
    
    /**
     * Verifica se o usuário tem uma role específica
     * 
     * @param string $role
     * @return bool
     */
    public static function hasRole(string $role): bool {
        return self::role() === $role;
    }
    
    /**
     * Verifica se o usuário é admin
     * 
     * @return bool
     */
    public static function isAdmin(): bool {
        return self::hasRole('admin');
    }
    
    /**
     * Verifica se o usuário tem permissão para acessar uma página
     * 
     * @param string $page
     * @return bool
     */
    public static function canAccess(string $page): bool {
        if (!self::isLoggedIn()) {
            return in_array($page, ['login', 'rastrear']);
        }
        
        // Admin tem acesso a tudo
        if (self::isAdmin()) {
            return true;
        }
        
        // Páginas públicas
        $publicPages = ['dashboard', 'perfil', 'rastrear', 'mercadorias', 'categorias', 'clientes'];
        if (in_array($page, $publicPages)) {
            return true;
        }
        
        // Verifica permissões customizadas no banco de dados
        $sql = "SELECT roles FROM menu_permissions WHERE page = ?";
        $result = Database::fetchOne($sql, [$page]);
        
        if (!$result) {
            return false;
        }
        
        $roles = json_decode($result['roles'], true) ?? [];
        return in_array(self::role(), $roles);
    }
    
    /**
     * Hash de uma senha
     * 
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
    
    /**
     * Verifica se uma senha corresponde ao hash
     * 
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}
