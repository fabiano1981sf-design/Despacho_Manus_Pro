<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use App\Auth;

class UsuarioController extends Controller {
    
    private User $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function index(): void {
        // Apenas admin pode acessar
        if (!Auth::isAdmin()) {
            $this->flashMessage('danger', 'Acesso negado.');
            $this->redirectTo('dashboard');
            return;
        }
        
        $usuarios = $this->userModel->all();
        $this->render('_usuarios', ['usuarios' => $usuarios]);
    }
    
    public function create(): void {
        if (!Auth::isAdmin()) {
            $this->flashMessage('danger', 'Acesso negado.');
            $this->redirectTo('dashboard');
            return;
        }
        
        $this->render('_usuarios_form', []);
    }
    
    public function store(): void {
        if (!Auth::isAdmin()) {
            $this->json(['success' => false, 'message' => 'Acesso negado.'], 403);
        }
        
        $data = $this->sanitize($_POST);
        
        $rules = [
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'senha' => 'required|min:6',
            'role' => 'required',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('usuarios');
            return;
        }
        
        // Verifica se email já existe
        $existing = $this->userModel->findByEmail($data['email']);
        if ($existing) {
            $this->flashMessage('danger', 'Email já cadastrado no sistema.');
            $this->redirectTo('usuarios');
            return;
        }
        
        if ($this->userModel->createUser($data)) {
            $this->flashMessage('success', 'Usuário criado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao criar usuário.');
        }
        
        $this->redirectTo('usuarios');
    }
    
    public function edit(): void {
        if (!Auth::isAdmin()) {
            $this->flashMessage('danger', 'Acesso negado.');
            $this->redirectTo('dashboard');
            return;
        }
        
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->redirectTo('usuarios');
            return;
        }
        
        $usuario = $this->userModel->find($id);
        
        if (!$usuario) {
            $this->flashMessage('danger', 'Usuário não encontrado.');
            $this->redirectTo('usuarios');
            return;
        }
        
        $this->render('_usuarios_form', [
            'usuario' => $usuario,
            'isEdit' => true
        ]);
    }
    
    public function update(): void {
        if (!Auth::isAdmin()) {
            $this->json(['success' => false, 'message' => 'Acesso negado.'], 403);
        }
        
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('usuarios');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        if ($this->userModel->updateUser($id, $data)) {
            $this->flashMessage('success', 'Usuário atualizado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar usuário.');
        }
        
        $this->redirectTo('usuarios');
    }
    
    public function delete(): void {
        if (!Auth::isAdmin()) {
            $this->json(['success' => false, 'message' => 'Acesso negado.'], 403);
        }
        
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('usuarios');
            return;
        }
        
        if ($this->userModel->delete($id)) {
            $this->flashMessage('success', 'Usuário deletado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao deletar usuário.');
        }
        
        $this->redirectTo('usuarios');
    }
}
