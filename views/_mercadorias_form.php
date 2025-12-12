<?php
$pageTitle = isset($isEdit) && $isEdit ? 'Editar Mercadoria' : 'Nova Mercadoria';
$page = 'mercadorias';
$view = '_mercadorias_form';
?>

<div class="page-header">
    <h1><i class="fas fa-boxes"></i> <?php echo $pageTitle; ?></h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Formulário de Mercadoria
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=mercadorias">
                    <?php if (isset($isEdit) && $isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $mercadoria['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Mercadoria *</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?php echo isset($mercadoria) ? htmlspecialchars($mercadoria['nome']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU (Código) *</label>
                        <input type="text" class="form-control" id="sku" name="sku" 
                               value="<?php echo isset($mercadoria) ? htmlspecialchars($mercadoria['sku']) : ''; ?>" 
                               placeholder="Ex: PROD001" required>
                        <small class="text-muted">Código único para identificação do produto</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoria</label>
                        <select class="form-select" id="categoria_id" name="categoria_id">
                            <option value="">Selecione uma categoria</option>
                            <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria['id']; ?>" 
                                    <?php echo isset($mercadoria) && $mercadoria['categoria_id'] == $categoria['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($categoria['nome']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantidade_estoque" class="form-label">Quantidade em Estoque *</label>
                        <input type="number" class="form-control" id="quantidade_estoque" name="quantidade_estoque" 
                               value="<?php echo isset($mercadoria) ? $mercadoria['quantidade_estoque'] : '0'; ?>" 
                               min="0" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="preco_unitario" class="form-label">Preço Unitário</label>
                        <input type="number" class="form-control" id="preco_unitario" name="preco_unitario" 
                               value="<?php echo isset($mercadoria) ? $mercadoria['preco_unitario'] : '0'; ?>" 
                               step="0.01" min="0">
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo isset($mercadoria) ? htmlspecialchars($mercadoria['descricao'] ?? '') : ''; ?></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="index.php?page=mercadorias" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informações
            </div>
            <div class="card-body">
                <p><strong>SKU:</strong> Código único para identificar o produto no sistema</p>
                <p><strong>Categoria:</strong> Agrupa produtos similares</p>
                <p><strong>Estoque:</strong> Quantidade disponível do produto</p>
                <p><strong>Preço:</strong> Valor unitário do produto</p>
            </div>
        </div>
    </div>
</div>
