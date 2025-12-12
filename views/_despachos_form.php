<?php
$pageTitle = isset($isEdit) && $isEdit ? 'Editar Despacho' : 'Novo Despacho';
$page = 'despachos';
$view = '_despachos_form';
?>

<div class="page-header">
    <h1><i class="fas fa-shipping-fast"></i> <?php echo $pageTitle; ?></h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Formulário de Despacho
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=despachos">
                    <?php if (isset($isEdit) && $isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $despacho['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número do Despacho *</label>
                        <input type="text" class="form-control" id="numero" name="numero" 
                               value="<?php echo isset($despacho) ? htmlspecialchars($despacho['numero']) : ''; ?>" 
                               placeholder="Ex: DESP001" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cliente_id" class="form-label">Cliente *</label>
                            <select class="form-select" id="cliente_id" name="cliente_id" required>
                                <option value="">Selecione um cliente</option>
                                <?php foreach ($clientes as $cliente): ?>
                                <option value="<?php echo $cliente['id']; ?>" 
                                        <?php echo isset($despacho) && $despacho['cliente_id'] == $cliente['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cliente['nome_razao']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mercadoria_id" class="form-label">Mercadoria *</label>
                            <select class="form-select" id="mercadoria_id" name="mercadoria_id" required>
                                <option value="">Selecione uma mercadoria</option>
                                <?php foreach ($mercadorias as $mercadoria): ?>
                                <option value="<?php echo $mercadoria['id']; ?>" 
                                        <?php echo isset($despacho) && $despacho['mercadoria_id'] == $mercadoria['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($mercadoria['nome']); ?> (<?php echo $mercadoria['sku']; ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantidade" class="form-label">Quantidade *</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" 
                                   value="<?php echo isset($despacho) ? $despacho['quantidade'] : '1'; ?>" 
                                   min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="transportadora_id" class="form-label">Transportadora</label>
                            <select class="form-select" id="transportadora_id" name="transportadora_id">
                                <option value="">Selecione uma transportadora</option>
                                <?php foreach ($transportadoras as $transportadora): ?>
                                <option value="<?php echo $transportadora['id']; ?>" 
                                        <?php echo isset($despacho) && $despacho['transportadora_id'] == $transportadora['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($transportadora['nome']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data_saida" class="form-label">Data de Saída</label>
                            <input type="date" class="form-control" id="data_saida" name="data_saida" 
                                   value="<?php echo isset($despacho) ? $despacho['data_saida'] : ''; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="data_entrega" class="form-label">Data de Entrega</label>
                            <input type="date" class="form-control" id="data_entrega" name="data_entrega" 
                                   value="<?php echo isset($despacho) ? $despacho['data_entrega'] : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pendente" <?php echo isset($despacho) && $despacho['status'] === 'Pendente' ? 'selected' : ''; ?>>Pendente</option>
                            <option value="Em Trânsito" <?php echo isset($despacho) && $despacho['status'] === 'Em Trânsito' ? 'selected' : ''; ?>>Em Trânsito</option>
                            <option value="Entregue" <?php echo isset($despacho) && $despacho['status'] === 'Entregue' ? 'selected' : ''; ?>>Entregue</option>
                            <option value="Cancelado" <?php echo isset($despacho) && $despacho['status'] === 'Cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4"><?php echo isset($despacho) ? htmlspecialchars($despacho['observacoes'] ?? '') : ''; ?></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                        <a href="index.php?page=despachos" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
