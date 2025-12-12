<?php
use App\Auth;

$pageTitle = 'Meu Perfil';
$page = 'perfil';
$view = '_perfil';
$user = Auth::user();
?>

<div class="page-header">
    <h1><i class="fas fa-user"></i> Meu Perfil</h1>
    <p class="text-muted">Gerenciar informações pessoais</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-form"></i> Informações Pessoais
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?page=perfil">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?php echo isset($usuario) ? htmlspecialchars($usuario['nome']) : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo isset($usuario) ? htmlspecialchars($usuario['email']) : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="senha" class="form-label">Nova Senha (deixe em branco para manter)</label>
                        <input type="password" class="form-control" id="senha" name="senha" 
                               placeholder="Digite uma nova senha ou deixe em branco">
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">Perfil</label>
                        <input type="text" class="form-control" id="role" 
                               value="<?php echo isset($usuario) ? htmlspecialchars($usuario['role']) : ''; ?>" 
                               disabled>
                        <small class="text-muted">Seu perfil não pode ser alterado. Contate um administrador.</small>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informações da Conta
            </div>
            <div class="card-body">
                <p>
                    <strong>ID:</strong> <?php echo $user['id'] ?? 'N/A'; ?><br>
                    <strong>Nome:</strong> <?php echo htmlspecialchars($user['name'] ?? 'N/A'); ?><br>
                    <strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?><br>
                    <strong>Perfil:</strong> <?php echo htmlspecialchars($user['role'] ?? 'N/A'); ?><br>
                    <strong>Data/Hora:</strong> <?php echo date('d/m/Y H:i:s'); ?>
                </p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-lock"></i> Segurança
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Altere sua senha regularmente para manter sua conta segura.
                </p>
                <p class="text-muted small">
                    Última alteração: Nunca
                </p>
            </div>
        </div>
    </div>
</div>
