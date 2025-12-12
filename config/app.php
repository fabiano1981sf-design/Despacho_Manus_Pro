<?php

/**
 * Configurações Gerais da Aplicação
 */

return [
    'name' => $_ENV['SITE_NAME'] ?? 'DespachoSys PRO',
    'url' => $_ENV['SITE_URL'] ?? 'http://localhost:8000',
    'env' => $_ENV['APP_ENV'] ?? 'development',
    'debug' => (bool)($_ENV['APP_DEBUG'] ?? false),
    'key' => $_ENV['APP_KEY'] ?? 'some_random_secret_key',
    
    // Configurações de Sessão
    'session' => [
        'lifetime' => 120, // minutos
        'secure' => false, // HTTPS only (mude para true em produção)
        'http_only' => true,
        'same_site' => 'Lax',
    ],
    
    // Configurações de Paginação
    'pagination' => [
        'per_page' => 15,
    ],
    
    // Roles de Usuário
    'roles' => [
        'admin' => 'Administrador',
        'gerente' => 'Gerente',
        'vendedor' => 'Vendedor',
        'operador' => 'Operador',
        'cliente' => 'Cliente',
    ],
    
    // Estatuses de Despacho
    'despacho_statuses' => [
        'Pendente' => 'Pendente',
        'Em Trânsito' => 'Em Trânsito',
        'Entregue' => 'Entregue',
        'Cancelado' => 'Cancelado',
    ],
];
