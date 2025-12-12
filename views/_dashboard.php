<?php
$pageTitle = 'Dashboard';
$page = 'dashboard';
$view = '_dashboard';
?>

<div class="page-header">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <p class="text-muted">Bem-vindo ao DespachoSys PRO</p>
</div>

<div class="row">
    <!-- Card: Total de Mercadorias -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total de Mercadorias</h6>
                    <div class="stat-value"><?php echo $stats['total_mercadorias'] ?? 0; ?></div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card: Quantidade em Estoque -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #1cc88a 0%, #0d9e5f 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Quantidade em Estoque</h6>
                    <div class="stat-value"><?php echo $stats['qtd_total_estoque'] ?? 0; ?></div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-warehouse"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card: Total de Clientes -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #36b9cc 0%, #0a8fa3 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total de Clientes</h6>
                    <div class="stat-value"><?php echo $stats['total_clientes'] ?? 0; ?></div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card: Despachos Pendentes -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #f6c23e 0%, #daa520 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Despachos Pendentes</h6>
                    <div class="stat-value"><?php echo $stats['despachos_pendentes'] ?? 0; ?></div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Card: Pedidos do Mês -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-shopping-cart"></i> Pedidos do Mês
            </div>
            <div class="card-body">
                <div class="display-4 text-primary"><?php echo $stats['pedidos_mes'] ?? 0; ?></div>
                <p class="text-muted mb-0">Pedidos de venda registrados neste mês</p>
            </div>
        </div>
    </div>
    
    <!-- Card: Oportunidades Abertas -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-bullhorn"></i> Oportunidades Abertas
            </div>
            <div class="card-body">
                <div class="display-4 text-success"><?php echo $stats['oportunidades_abertas'] ?? 0; ?></div>
                <p class="text-muted mb-0">Oportunidades de venda em aberto</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informações do Sistema
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nome do Sistema:</strong> DespachoSys PRO</p>
                        <p><strong>Versão:</strong> 2.0.0</p>
                        <p><strong>Ambiente:</strong> <?php echo $_ENV['APP_ENV'] ?? 'production'; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>PHP:</strong> <?php echo phpversion(); ?></p>
                        <p><strong>Servidor:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Desconhecido'; ?></p>
                        <p><strong>Data/Hora:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
