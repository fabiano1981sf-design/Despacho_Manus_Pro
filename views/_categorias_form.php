<?php
$pageTitle = isset($isEdit) && $isEdit ? 'Editar Categoria' : 'Nova Categoria';
$page = 'categorias';
$view = '_categorias_form';
?>

<div class="page-header">
    <h1><i class="fas fa-tags"></i> <?php echo $pageTitle; ?></h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Formulário de Categoria
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=categorias">
                    <?php if (isset($isEdit) && $isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria *</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?php echo isset($categoria) ? htmlspecialchars($categoria['nome']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo isset($categoria) ? htmlspecialchars($categoria['descricao'] ?? '') : ''; ?></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="index.php?page=categorias" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
