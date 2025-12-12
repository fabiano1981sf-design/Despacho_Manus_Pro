<?php

namespace App;

/**
 * Classe Router
 * Gerencia o roteamento de requisições para controladores
 */
class Router {
    
    private static array $routes = [];
    private static string $currentPage = 'dashboard';
    private static array $currentParams = [];
    
    /**
     * Registra uma rota GET
     * 
     * @param string $page
     * @param string $controller
     * @param string $action
     */
    public static function get(string $page, string $controller, string $action = 'index'): void {
        self::$routes[$page] = [
            'controller' => $controller,
            'action' => $action,
            'method' => 'GET'
        ];
    }
    
    /**
     * Registra uma rota POST
     * 
     * @param string $page
     * @param string $controller
     * @param string $action
     */
    public static function post(string $page, string $controller, string $action = 'store'): void {
        self::$routes[$page] = [
            'controller' => $controller,
            'action' => $action,
            'method' => 'POST'
        ];
    }
    
    /**
     * Processa a requisição atual
     */
    public static function dispatch(): void {
        $page = $_GET['page'] ?? 'dashboard';
        $id = $_GET['id'] ?? null;
        $action = $_GET['action'] ?? null;
        
        self::$currentPage = $page;
        self::$currentParams = ['id' => $id, 'action' => $action];
        
        // Verifica se o usuário tem permissão para acessar a página
        if (!Auth::canAccess($page)) {
            if (!Auth::isLoggedIn()) {
                header('Location: index.php?page=login');
            } else {
                header('Location: index.php?page=dashboard&error=unauthorized');
            }
            exit;
        }
        
        // Se a rota está registrada, chama o controlador
        if (isset(self::$routes[$page])) {
            self::callController(self::$routes[$page]);
        } else {
            // Caso contrário, tenta incluir a view diretamente (compatibilidade com views antigas)
            self::renderView($page);
        }
    }
    
    /**
     * Chama um controlador
     * 
     * @param array $route
     */
    private static function callController(array $route): void {
        $controllerClass = "App\\Controllers\\" . $route['controller'];
        $action = $route['action'];
        
        if (!class_exists($controllerClass)) {
            die("Controlador não encontrado: {$controllerClass}");
        }
        
        $controller = new $controllerClass();
        
        if (!method_exists($controller, $action)) {
            die("Ação não encontrada: {$action} em {$controllerClass}");
        }
        
        $controller->$action();
    }
    
    /**
     * Renderiza uma view diretamente (compatibilidade)
     * 
     * @param string $page
     */
    private static function renderView(string $page): void {
        $viewPath = ROOT_PATH . "/views/_{$page}.php";
        
        if (!file_exists($viewPath)) {
            $viewPath = ROOT_PATH . "/views/_404.php";
        }
        
        include $viewPath;
    }
    
    /**
     * Obtém a página atual
     * 
     * @return string
     */
    public static function getCurrentPage(): string {
        return self::$currentPage;
    }
    
    /**
     * Obtém um parâmetro da requisição
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getParam(string $key, $default = null) {
        return self::$currentParams[$key] ?? $_GET[$key] ?? $_POST[$key] ?? $default;
    }
}
