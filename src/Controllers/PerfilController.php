<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Auth;

class PerfilController extends Controller {
    
    private User $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function index(): void {
        $user = Auth::user();
        
        if (!$user) {
            $this->redirectTo('login');
            return;
        }
        
        $userData = $this->userModel->find($user['id']);
        
        $this->render('_perfil', ['usuario' => $userData]);
    }
    
    public function update(): void {
        $userId = Auth::id();
        
        if (!$userId) {
            $this->redirectTo('login');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        $rules = [
            'nome' => 'required|min:3',
            'email' => 'required|email',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('perfil');
            return;
        }
        
        // Se houver nova senha, valida
        if (!empty($data['senha'])) {
            if (strlen($data['senha']) < 6) {
                $this->flashMessage('danger', 'A nova senha deve ter no mínimo 6 caracteres.');
                $this->redirectTo('perfil');
                return;
            }
        }
        
        if ($this->userModel->updateUser($userId, $data)) {
            $this->flashMessage('success', 'Perfil atualizado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar perfil.');
        }
        
        $this->redirectTo('perfil');
    }
}
