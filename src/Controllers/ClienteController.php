<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Cliente;

class ClienteController extends Controller {
    
    private Cliente $clienteModel;
    
    public function __construct() {
        $this->clienteModel = new Cliente();
    }
    
    public function index(): void {
        $clientes = $this->clienteModel->all();
        $this->render('_clientes', ['clientes' => $clientes]);
    }
    
    public function create(): void {
        $this->render('_clientes_form', []);
    }
    
    public function store(): void {
        $data = $this->sanitize($_POST);
        
        $rules = [
            'nome_razao' => 'required|min:3',
            'email' => 'email',
            'cnpj_cpf' => 'required',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('clientes');
            return;
        }
        
        // Verifica se CNPJ/CPF já existe
        $existing = $this->clienteModel->findByCnpjCpf($data['cnpj_cpf']);
        if ($existing) {
            $this->flashMessage('danger', 'CNPJ/CPF já cadastrado no sistema.');
            $this->redirectTo('clientes');
            return;
        }
        
        if ($this->clienteModel->create($data)) {
            $this->flashMessage('success', 'Cliente criado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao criar cliente.');
        }
        
        $this->redirectTo('clientes');
    }
    
    public function edit(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->redirectTo('clientes');
            return;
        }
        
        $cliente = $this->clienteModel->find($id);
        
        if (!$cliente) {
            $this->flashMessage('danger', 'Cliente não encontrado.');
            $this->redirectTo('clientes');
            return;
        }
        
        $this->render('_clientes_form', [
            'cliente' => $cliente,
            'isEdit' => true
        ]);
    }
    
    public function update(): void {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('clientes');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        if ($this->clienteModel->update($id, $data)) {
            $this->flashMessage('success', 'Cliente atualizado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar cliente.');
        }
        
        $this->redirectTo('clientes');
    }
    
    public function delete(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('clientes');
            return;
        }
        
        if ($this->clienteModel->delete($id)) {
            $this->flashMessage('success', 'Cliente deletado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao deletar cliente.');
        }
        
        $this->redirectTo('clientes');
    }
}
