<?php
$pageTitle = 'Transportadoras';
$page = 'transportadoras';
$view = '_transportadoras';
?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="fas fa-truck"></i> Transportadoras</h1>
        <p class="text-muted">Gerenciar transportadoras</p>
    </div>
    <a href="index.php?page=transportadoras&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nova Transportadora
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Lista de Transportadoras
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transportadoras)): ?>
                    <?php foreach ($transportadoras as $transportadora): ?>
                    <tr>
                        <td><?php echo $transportadora['id']; ?></td>
                        <td><?php echo htmlspecialchars($transportadora['nome']); ?></td>
                        <td><?php echo htmlspecialchars($transportadora['cnpj'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($transportadora['telefone'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($transportadora['email'] ?? 'N/A'); ?></td>
                        <td>
                            <a href="index.php?page=transportadoras&action=edit&id=<?php echo $transportadora['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?page=transportadoras&action=delete&id=<?php echo $transportadora['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">
                                <i class="fas fa-trash"></i> Deletar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Nenhuma transportadora cadastrada
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
