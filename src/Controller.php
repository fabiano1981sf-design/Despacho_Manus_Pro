<?php

namespace App;

/**
 * Classe Controller
 * Classe base abstrata para todos os controladores da aplicação
 */
abstract class Controller {
    
    protected array $data = [];
    protected string $view;
    
    /**
     * Renderiza uma view
     * 
     * @param string $view
     * @param array $data
     */
    protected function render(string $view, array $data = []): void {
        $this->view = $view;
        $this->data = array_merge($this->data, $data);
        
        $viewPath = ROOT_PATH . "/views/{$view}.php";
        
        if (!file_exists($viewPath)) {
            die("View não encontrada: {$viewPath}");
        }
        
        extract($this->data);
        include $viewPath;
    }
    
    /**
     * Retorna JSON
     * 
     * @param array $data
     * @param int $statusCode
     */
    protected function json(array $data, int $statusCode = 200): void {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
    
    /**
     * Redireciona para uma URL
     * 
     * @param string $url
     */
    protected function redirect(string $url): void {
        header("Location: {$url}");
        exit;
    }
    
    /**
     * Redireciona para uma página do sistema
     * 
     * @param string $page
     * @param array $params
     */
    protected function redirectTo(string $page, array $params = []): void {
        $url = "index.php?page={$page}";
        
        if (!empty($params)) {
            $url .= "&" . http_build_query($params);
        }
        
        $this->redirect($url);
    }
    
    /**
     * Define uma mensagem de flash
     * 
     * @param string $type (success, danger, warning, info)
     * @param string $message
     */
    protected function flashMessage(string $type, string $message): void {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'text' => $message,
        ];
    }
    
    /**
     * Obtém e limpa a mensagem de flash
     * 
     * @return array|null
     */
    protected function getFlashMessage(): ?array {
        $message = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']);
        return $message;
    }
    
    /**
     * Valida dados de entrada
     * 
     * @param array $data
     * @param array $rules
     * @return array
     */
    protected function validate(array $data, array $rules): array {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;
            
            if (strpos($rule, 'required') !== false && empty($value)) {
                $errors[$field] = "{$field} é obrigatório.";
            }
            
            if (strpos($rule, 'email') !== false && !empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "{$field} deve ser um email válido.";
            }
            
            if (strpos($rule, 'min:') !== false && !empty($value)) {
                preg_match('/min:(\d+)/', $rule, $matches);
                $min = (int)$matches[1] ?? 0;
                if (strlen($value) < $min) {
                    $errors[$field] = "{$field} deve ter no mínimo {$min} caracteres.";
                }
            }
            
            if (strpos($rule, 'max:') !== false && !empty($value)) {
                preg_match('/max:(\d+)/', $rule, $matches);
                $max = (int)$matches[1] ?? 0;
                if (strlen($value) > $max) {
                    $errors[$field] = "{$field} deve ter no máximo {$max} caracteres.";
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * Sanitiza dados de entrada
     * 
     * @param array $data
     * @return array
     */
    protected function sanitize(array $data): array {
        $sanitized = [];
        
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sanitized[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } else {
                $sanitized[$key] = $value;
            }
        }
        
        return $sanitized;
    }
}
