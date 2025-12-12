<?php
$pageTitle = 'Categorias';
$page = 'categorias';
$view = '_categorias';
?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="fas fa-tags"></i> Categorias</h1>
        <p class="text-muted">Gerenciar categorias de produtos</p>
    </div>
    <a href="index.php?page=categorias&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nova Categoria
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Lista de Categorias
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo $categoria['id']; ?></td>
                        <td><?php echo htmlspecialchars($categoria['nome']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['descricao'] ?? ''); ?></td>
                        <td>
                            <a href="index.php?page=categorias&action=edit&id=<?php echo $categoria['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?page=categorias&action=delete&id=<?php echo $categoria['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">
                                <i class="fas fa-trash"></i> Deletar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Nenhuma categoria cadastrada
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
