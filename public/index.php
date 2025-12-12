<?php

/**
 * Ponto de entrada da aplicação
 * Arquivo index.php - Carregador de autoload e inicializador
 */

// Define o caminho raiz da aplicação
define('ROOT_PATH', dirname(__DIR__));

// Carrega o autoloader do Composer
require ROOT_PATH . '/vendor/autoload.php';

// Carrega variáveis de ambiente
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT_PATH);
$dotenv->safeLoad();

// Inicia a sessão
session_start();

// Importa as classes necessárias
use App\Auth;
use App\Router;

// Verifica se o usuário está tentando acessar uma página protegida sem estar logado
$page = $_GET['page'] ?? 'dashboard';

// Redireciona para login se não estiver autenticado
if (!Auth::isLoggedIn() && !in_array($page, ['login', 'rastrear'])) {
    header('Location: index.php?page=login');
    exit;
}

// Se está logado e tenta acessar login, redireciona para dashboard
if (Auth::isLoggedIn() && $page === 'login') {
    header('Location: index.php?page=dashboard');
    exit;
}

// Registra as rotas da aplicação

// Rotas de Autenticação
Router::get('dashboard', 'DashboardController', 'index');
Router::get('login', 'AuthController', 'login');
Router::post('login', 'AuthController', 'login');
Router::get('logout', 'AuthController', 'logout');

// Rotas de Perfil
Router::get('perfil', 'PerfilController', 'index');
Router::post('perfil', 'PerfilController', 'update');

// Rotas de Mercadorias
Router::get('mercadorias', 'MercadoriaController', 'index');
Router::post('mercadorias', 'MercadoriaController', 'store');
Router::get('mercadorias_edit', 'MercadoriaController', 'edit');
Router::post('mercadorias_update', 'MercadoriaController', 'update');
Router::get('mercadorias_delete', 'MercadoriaController', 'delete');

// Rotas de Clientes
Router::get('clientes', 'ClienteController', 'index');
Router::post('clientes', 'ClienteController', 'store');
Router::get('clientes_edit', 'ClienteController', 'edit');
Router::post('clientes_update', 'ClienteController', 'update');
Router::get('clientes_delete', 'ClienteController', 'delete');

// Rotas de Despachos
Router::get('despachos', 'DespachoController', 'index');
Router::post('despachos', 'DespachoController', 'store');
Router::get('despachos_edit', 'DespachoController', 'edit');
Router::post('despachos_update', 'DespachoController', 'update');
Router::get('despachos_delete', 'DespachoController', 'delete');

// Rotas de Categorias
Router::get('categorias', 'CategoriaController', 'index');
Router::post('categorias', 'CategoriaController', 'store');
Router::get('categorias_edit', 'CategoriaController', 'edit');
Router::post('categorias_update', 'CategoriaController', 'update');
Router::get('categorias_delete', 'CategoriaController', 'delete');

// Rotas de Transportadoras
Router::get('transportadoras', 'TransportadoraController', 'index');
Router::post('transportadoras', 'TransportadoraController', 'store');
Router::get('transportadoras_edit', 'TransportadoraController', 'edit');
Router::post('transportadoras_update', 'TransportadoraController', 'update');
Router::get('transportadoras_delete', 'TransportadoraController', 'delete');

// Rotas de Usuários
Router::get('usuarios', 'UsuarioController', 'index');
Router::post('usuarios', 'UsuarioController', 'store');
Router::get('usuarios_edit', 'UsuarioController', 'edit');
Router::post('usuarios_update', 'UsuarioController', 'update');
Router::get('usuarios_delete', 'UsuarioController', 'delete');

// Processa a requisição
Router::dispatch();
