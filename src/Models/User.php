<?php

namespace App\Models;

use App\Model;

/**
 * Modelo User
 * Gerencia dados de usuários
 */
class User extends Model {
    
    protected string $table = 'users';
    protected array $fillable = ['nome', 'email', 'role', 'senha_hash', 'foto_perfil'];
    protected array $hidden = ['senha_hash'];
    
    /**
     * Obtém um usuário pelo email
     * 
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email): ?array {
        return $this->findBy('email', $email);
    }
    
    /**
     * Obtém todos os usuários com uma role específica
     * 
     * @param string $role
     * @return array
     */
    public function findByRole(string $role): array {
        return $this->findAllBy('role', $role);
    }
    
    /**
     * Cria um novo usuário com hash de senha
     * 
     * @param array $data
     * @return bool
     */
    public function createUser(array $data): bool {
        if (empty($data['senha'])) {
            return false;
        }
        
        $data['senha_hash'] = password_hash($data['senha'], PASSWORD_BCRYPT, ['cost' => 12]);
        unset($data['senha']);
        
        return $this->create($data);
    }
    
    /**
     * Atualiza um usuário
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser(int $id, array $data): bool {
        if (isset($data['senha']) && !empty($data['senha'])) {
            $data['senha_hash'] = password_hash($data['senha'], PASSWORD_BCRYPT, ['cost' => 12]);
            unset($data['senha']);
        }
        
        return $this->update($id, $data);
    }
}
