<?php
$pageTitle = isset($isEdit) && $isEdit ? 'Editar Transportadora' : 'Nova Transportadora';
$page = 'transportadoras';
$view = '_transportadoras_form';
?>

<div class="page-header">
    <h1><i class="fas fa-truck"></i> <?php echo $pageTitle; ?></h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Formulário de Transportadora
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=transportadoras">
                    <?php if (isset($isEdit) && $isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $transportadora['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Transportadora *</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?php echo isset($transportadora) ? htmlspecialchars($transportadora['nome']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cnpj" class="form-label">CNPJ *</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" 
                                   value="<?php echo isset($transportadora) ? htmlspecialchars($transportadora['cnpj']) : ''; ?>" 
                                   placeholder="00.000.000/0000-00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" 
                                   value="<?php echo isset($transportadora) ? htmlspecialchars($transportadora['telefone']) : ''; ?>" 
                                   placeholder="(11) 99999-9999">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo isset($transportadora) ? htmlspecialchars($transportadora['email']) : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" 
                               value="<?php echo isset($transportadora) ? htmlspecialchars($transportadora['endereco']) : ''; ?>" 
                               placeholder="Rua, número, complemento">
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="index.php?page=transportadoras" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
