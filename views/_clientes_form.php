<?php
$pageTitle = isset($isEdit) && $isEdit ? 'Editar Cliente' : 'Novo Cliente';
$page = 'clientes';
$view = '_clientes_form';
?>

<div class="page-header">
    <h1><i class="fas fa-handshake"></i> <?php echo $pageTitle; ?></h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Formulário de Cliente
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=clientes">
                    <?php if (isset($isEdit) && $isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome_razao" class="form-label">Nome/Razão Social *</label>
                        <input type="text" class="form-control" id="nome_razao" name="nome_razao" 
                               value="<?php echo isset($cliente) ? htmlspecialchars($cliente['nome_razao']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cnpj_cpf" class="form-label">CNPJ/CPF *</label>
                            <input type="text" class="form-control" id="cnpj_cpf" name="cnpj_cpf" 
                                   value="<?php echo isset($cliente) ? htmlspecialchars($cliente['cnpj_cpf']) : ''; ?>" 
                                   placeholder="00.000.000/0000-00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-select" id="tipo" name="tipo">
                                <option value="Pessoa Física" <?php echo isset($cliente) && $cliente['tipo'] === 'Pessoa Física' ? 'selected' : ''; ?>>Pessoa Física</option>
                                <option value="Pessoa Jurídica" <?php echo isset($cliente) && $cliente['tipo'] === 'Pessoa Jurídica' ? 'selected' : ''; ?>>Pessoa Jurídica</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo isset($cliente) ? htmlspecialchars($cliente['email']) : ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" 
                                   value="<?php echo isset($cliente) ? htmlspecialchars($cliente['telefone']) : ''; ?>" 
                                   placeholder="(11) 99999-9999">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" 
                               value="<?php echo isset($cliente) ? htmlspecialchars($cliente['endereco']) : ''; ?>" 
                               placeholder="Rua, número, complemento">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" 
                                   value="<?php echo isset($cliente) ? htmlspecialchars($cliente['cidade']) : ''; ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" 
                                   value="<?php echo isset($cliente) ? htmlspecialchars($cliente['estado']) : ''; ?>" 
                                   maxlength="2" placeholder="SP">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" 
                                   value="<?php echo isset($cliente) ? htmlspecialchars($cliente['cep']) : ''; ?>" 
                                   placeholder="00000-000">
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="index.php?page=clientes" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
