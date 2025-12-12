<?php
$pageTitle = 'Mercadorias';
$page = 'mercadorias';
$view = '_mercadorias';
?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="fas fa-boxes"></i> Mercadorias</h1>
        <p class="text-muted">Gerenciar produtos e estoque</p>
    </div>
    <a href="index.php?page=mercadorias&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nova Mercadoria
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Lista de Mercadorias
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>SKU</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($mercadorias)): ?>
                    <?php foreach ($mercadorias as $mercadoria): ?>
                    <tr>
                        <td><?php echo $mercadoria['id']; ?></td>
                        <td><?php echo htmlspecialchars($mercadoria['nome']); ?></td>
                        <td>
                            <span class="badge bg-info"><?php echo htmlspecialchars($mercadoria['sku']); ?></span>
                        </td>
                        <td><?php echo htmlspecialchars($mercadoria['categoria_nome'] ?? 'N/A'); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $mercadoria['quantidade_estoque'] > 0 ? 'success' : 'danger'; ?>">
                                <?php echo $mercadoria['quantidade_estoque']; ?> un.
                            </span>
                        </td>
                        <td>
                            <a href="index.php?page=mercadorias&action=edit&id=<?php echo $mercadoria['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?page=mercadorias&action=delete&id=<?php echo $mercadoria['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">
                                <i class="fas fa-trash"></i> Deletar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Nenhuma mercadoria cadastrada
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
