<?php

namespace App;

/**
 * Classe View
 * Gerencia a renderização de views e layouts
 */
class View {
    
    private static array $data = [];
    private static string $layout = 'layouts/main';
    
    /**
     * Define dados para a view
     * 
     * @param array $data
     */
    public static function setData(array $data): void {
        self::$data = array_merge(self::$data, $data);
    }
    
    /**
     * Define o layout a ser utilizado
     * 
     * @param string $layout
     */
    public static function setLayout(string $layout): void {
        self::$layout = $layout;
    }
    
    /**
     * Renderiza uma view com o layout
     * 
     * @param string $view
     * @param array $data
     */
    public static function render(string $view, array $data = []): void {
        self::setData($data);
        
        $layoutPath = ROOT_PATH . "/views/" . self::$layout . ".php";
        $viewPath = ROOT_PATH . "/views/{$view}.php";
        
        if (!file_exists($layoutPath)) {
            die("Layout não encontrado: {$layoutPath}");
        }
        
        if (!file_exists($viewPath)) {
            die("View não encontrada: {$viewPath}");
        }
        
        // Extrai as variáveis para o escopo da view
        extract(self::$data);
        
        // Inclui o layout (que incluirá a view)
        include $layoutPath;
    }
    
    /**
     * Renderiza uma view sem layout
     * 
     * @param string $view
     * @param array $data
     */
    public static function renderPartial(string $view, array $data = []): void {
        $viewPath = ROOT_PATH . "/views/{$view}.php";
        
        if (!file_exists($viewPath)) {
            die("View não encontrada: {$viewPath}");
        }
        
        extract(array_merge(self::$data, $data));
        include $viewPath;
    }
    
    /**
     * Obtém um valor de dados
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null) {
        return self::$data[$key] ?? $default;
    }
    
    /**
     * Verifica se uma chave existe nos dados
     * 
     * @param string $key
     * @return bool
     */
    public static function has(string $key): bool {
        return isset(self::$data[$key]);
    }
    
    /**
     * Escapa HTML para segurança
     * 
     * @param string $text
     * @return string
     */
    public static function escape(string $text): string {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Renderiza um alerta Bootstrap
     * 
     * @param string $type (success, danger, warning, info)
     * @param string $message
     * @return string
     */
    public static function alert(string $type, string $message): string {
        $icon = match($type) {
            'success' => 'check-circle',
            'danger' => 'exclamation-circle',
            'warning' => 'exclamation-triangle',
            'info' => 'info-circle',
            default => 'info-circle'
        };
        
        return "
        <div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
            <i class='fas fa-{$icon}'></i> " . self::escape($message) . "
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
    }
    
    /**
     * Renderiza um badge
     * 
     * @param string $text
     * @param string $type
     * @return string
     */
    public static function badge(string $text, string $type = 'primary'): string {
        return "<span class='badge bg-{$type}'>" . self::escape($text) . "</span>";
    }
    
    /**
     * Renderiza um botão
     * 
     * @param string $text
     * @param string $url
     * @param string $type
     * @param string $class
     * @return string
     */
    public static function button(string $text, string $url = '#', string $type = 'primary', string $class = ''): string {
        return "<a href='{$url}' class='btn btn-{$type} {$class}'>" . self::escape($text) . "</a>";
    }
    
    /**
     * Renderiza um input de formulário
     * 
     * @param string $name
     * @param string $label
     * @param string $type
     * @param string $value
     * @param bool $required
     * @return string
     */
    public static function input(string $name, string $label = '', string $type = 'text', string $value = '', bool $required = false): string {
        $label = $label ?: ucfirst(str_replace('_', ' ', $name));
        $required_attr = $required ? 'required' : '';
        
        return "
        <div class='mb-3'>
            <label for='{$name}' class='form-label'>{$label}</label>
            <input type='{$type}' class='form-control' id='{$name}' name='{$name}' value='" . self::escape($value) . "' {$required_attr}>
        </div>";
    }
    
    /**
     * Renderiza um textarea
     * 
     * @param string $name
     * @param string $label
     * @param string $value
     * @param bool $required
     * @return string
     */
    public static function textarea(string $name, string $label = '', string $value = '', bool $required = false): string {
        $label = $label ?: ucfirst(str_replace('_', ' ', $name));
        $required_attr = $required ? 'required' : '';
        
        return "
        <div class='mb-3'>
            <label for='{$name}' class='form-label'>{$label}</label>
            <textarea class='form-control' id='{$name}' name='{$name}' {$required_attr}>" . self::escape($value) . "</textarea>
        </div>";
    }
    
    /**
     * Renderiza um select
     * 
     * @param string $name
     * @param array $options
     * @param string $label
     * @param string $selected
     * @param bool $required
     * @return string
     */
    public static function select(string $name, array $options, string $label = '', string $selected = '', bool $required = false): string {
        $label = $label ?: ucfirst(str_replace('_', ' ', $name));
        $required_attr = $required ? 'required' : '';
        
        $html = "
        <div class='mb-3'>
            <label for='{$name}' class='form-label'>{$label}</label>
            <select class='form-select' id='{$name}' name='{$name}' {$required_attr}>";
        
        $html .= "<option value=''>Selecione...</option>";
        
        foreach ($options as $value => $text) {
            $selected_attr = $value == $selected ? 'selected' : '';
            $html .= "<option value='{$value}' {$selected_attr}>" . self::escape($text) . "</option>";
        }
        
        $html .= "</select></div>";
        
        return $html;
    }
}
