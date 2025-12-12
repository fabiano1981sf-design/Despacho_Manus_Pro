<?php
$pageTitle = 'Despachos';
$page = 'despachos';
$view = '_despachos';
?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="fas fa-shipping-fast"></i> Despachos</h1>
        <p class="text-muted">Gerenciar despachos e rastreamento</p>
    </div>
    <a href="index.php?page=despachos&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Despacho
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Lista de Despachos
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número</th>
                    <th>Cliente</th>
                    <th>Quantidade</th>
                    <th>Status</th>
                    <th>Data de Saída</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($despachos)): ?>
                    <?php foreach ($despachos as $despacho): ?>
                    <tr>
                        <td><?php echo $despacho['id']; ?></td>
                        <td><?php echo htmlspecialchars($despacho['numero'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($despacho['cliente_id'] ?? 'N/A'); ?></td>
                        <td><?php echo $despacho['quantidade'] ?? 0; ?></td>
                        <td>
                            <span class="badge bg-<?php 
                                echo match($despacho['status'] ?? '') {
                                    'Entregue' => 'success',
                                    'Em Trânsito' => 'info',
                                    'Cancelado' => 'danger',
                                    default => 'warning'
                                };
                            ?>">
                                <?php echo htmlspecialchars($despacho['status'] ?? 'Pendente'); ?>
                            </span>
                        </td>
                        <td><?php echo $despacho['data_saida'] ?? 'N/A'; ?></td>
                        <td>
                            <a href="index.php?page=despachos&action=edit&id=<?php echo $despacho['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?page=despachos&action=delete&id=<?php echo $despacho['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">
                                <i class="fas fa-trash"></i> Deletar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Nenhum despacho cadastrado
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
