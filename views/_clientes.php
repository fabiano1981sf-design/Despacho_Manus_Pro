<?php
$pageTitle = 'Clientes';
$page = 'clientes';
$view = '_clientes';
?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="fas fa-handshake"></i> Clientes</h1>
        <p class="text-muted">Gerenciar dados de clientes</p>
    </div>
    <a href="index.php?page=clientes&action=create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Cliente
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Lista de Clientes
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome/Razão Social</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome_razao']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($cliente['cidade'] ?? 'N/A'); ?></td>
                        <td>
                            <a href="index.php?page=clientes&action=edit&id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?page=clientes&action=delete&id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">
                                <i class="fas fa-trash"></i> Deletar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Nenhum cliente cadastrado
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
