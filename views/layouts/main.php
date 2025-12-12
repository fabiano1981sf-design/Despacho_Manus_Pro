<?php
use App\Auth;
use App\View;

$user = Auth::user();
$siteName = $_ENV['SITE_NAME'] ?? 'DespachoSys PRO';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $siteName; ?> | <?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --danger-color: #e74c3c;
            --warning-color: #f6c23e;
            --info-color: #36b9cc;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #fff;
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.2);
            border-left-color: #fff;
            font-weight: 600;
        }
        
        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }
        
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        
        .topbar {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .page-header {
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #2e3338;
        }
        
        .card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1.5rem;
            font-weight: 600;
            color: #2e3338;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #224abe;
            border-color: #224abe;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: #f8f9fc;
            border-top: 1px solid #e3e6f0;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 600;
            color: #2e3338;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #e3e6f0;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fc;
        }
        
        .badge {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
        
        .form-control, .form-select {
            border: 1px solid #d1d3d6;
            border-radius: 0.35rem;
            padding: 0.75rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .alert {
            border-radius: 0.35rem;
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: #fff;
            padding: 2rem;
            border-radius: 0.35rem;
            margin-bottom: 1.5rem;
        }
        
        .stat-card h6 {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
        }
        
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        
        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: 0.3;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                width: 250px;
                height: 100vh;
                z-index: 999;
                transition: left 0.3s ease;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-cube"></i> <?php echo $siteName; ?>
            </div>
            <hr class="my-0 bg-light">
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'dashboard' ? 'active' : ''; ?>" href="index.php?page=dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'mercadorias' ? 'active' : ''; ?>" href="index.php?page=mercadorias">
                        <i class="fas fa-boxes"></i> Mercadorias
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'categorias' ? 'active' : ''; ?>" href="index.php?page=categorias">
                        <i class="fas fa-tags"></i> Categorias
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'clientes' ? 'active' : ''; ?>" href="index.php?page=clientes">
                        <i class="fas fa-handshake"></i> Clientes
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'despachos' ? 'active' : ''; ?>" href="index.php?page=despachos">
                        <i class="fas fa-shipping-fast"></i> Despachos
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'transportadoras' ? 'active' : ''; ?>" href="index.php?page=transportadoras">
                        <i class="fas fa-truck"></i> Transportadoras
                    </a>
                </li>
                
                <?php if (Auth::isAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'usuarios' ? 'active' : ''; ?>" href="index.php?page=usuarios">
                        <i class="fas fa-users"></i> Usuários
                    </a>
                </li>
                <?php endif; ?>
                
                <hr class="my-3 bg-light">
                
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($page) && $page === 'perfil' ? 'active' : ''; ?>" href="index.php?page=perfil">
                        <i class="fas fa-user"></i> Meu Perfil
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=logout">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <button class="btn btn-sm btn-outline-primary d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="ms-auto d-flex align-items-center gap-3">
                    <span class="text-muted">
                        <i class="fas fa-user-circle"></i> <?php echo $user['name'] ?? 'Usuário'; ?>
                    </span>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="container-fluid px-4">
                <?php
                // Exibe mensagem de flash se existir
                if (isset($_SESSION['flash_message'])):
                    $flash = $_SESSION['flash_message'];
                    unset($_SESSION['flash_message']);
                ?>
                <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                    <i class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo $flash['text']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <!-- Incluir a view específica -->
                <?php
                $viewFile = ROOT_PATH . "/views/" . $view . ".php";
                if (file_exists($viewFile)) {
                    include $viewFile;
                } else {
                    echo '<div class="alert alert-danger">View não encontrada: ' . $view . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (opcional, para compatibilidade) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script src="js/sb-admin-2.min.js"></script>
    
    <script>
        // Toggle sidebar em mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        // Fechar sidebar ao clicar em um link
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('sidebar').classList.remove('show');
            });
        });
    </script>
</body>
</html>
