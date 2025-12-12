<?php
$pageTitle = isset($isEdit) && $isEdit ? 'Editar Usuário' : 'Novo Usuário';
$page = 'usuarios';
$view = '_usuarios_form';
?>

<div class="page-header">
    <h1><i class="fas fa-users"></i> <?php echo $pageTitle; ?></h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Formulário de Usuário
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=usuarios">
                    <?php if (isset($isEdit) && $isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?php echo isset($usuario) ? htmlspecialchars($usuario['nome']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo isset($usuario) ? htmlspecialchars($usuario['email']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="senha" class="form-label"><?php echo isset($isEdit) && $isEdit ? 'Nova Senha (deixe em branco para manter)' : 'Senha'; ?> <?php echo !isset($isEdit) || !$isEdit ? '*' : ''; ?></label>
                        <input type="password" class="form-control" id="senha" name="senha" 
                               <?php echo !isset($isEdit) || !$isEdit ? 'required' : ''; ?>>
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">Role (Perfil) *</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Selecione um perfil</option>
                            <option value="admin" <?php echo isset($usuario) && $usuario['role'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                            <option value="gerente" <?php echo isset($usuario) && $usuario['role'] === 'gerente' ? 'selected' : ''; ?>>Gerente</option>
                            <option value="vendedor" <?php echo isset($usuario) && $usuario['role'] === 'vendedor' ? 'selected' : ''; ?>>Vendedor</option>
                            <option value="operador" <?php echo isset($usuario) && $usuario['role'] === 'operador' ? 'selected' : ''; ?>>Operador</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="index.php?page=usuarios" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
