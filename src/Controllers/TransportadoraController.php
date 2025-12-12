<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Transportadora;

class TransportadoraController extends Controller {
    
    private Transportadora $transportadoraModel;
    
    public function __construct() {
        $this->transportadoraModel = new Transportadora();
    }
    
    public function index(): void {
        $transportadoras = $this->transportadoraModel->all();
        $this->render('_transportadoras', ['transportadoras' => $transportadoras]);
    }
    
    public function create(): void {
        $this->render('_transportadoras_form', []);
    }
    
    public function store(): void {
        $data = $this->sanitize($_POST);
        
        $rules = [
            'nome' => 'required|min:3',
            'cnpj' => 'required',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('transportadoras');
            return;
        }
        
        if ($this->transportadoraModel->create($data)) {
            $this->flashMessage('success', 'Transportadora criada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao criar transportadora.');
        }
        
        $this->redirectTo('transportadoras');
    }
    
    public function edit(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->redirectTo('transportadoras');
            return;
        }
        
        $transportadora = $this->transportadoraModel->find($id);
        
        if (!$transportadora) {
            $this->flashMessage('danger', 'Transportadora não encontrada.');
            $this->redirectTo('transportadoras');
            return;
        }
        
        $this->render('_transportadoras_form', [
            'transportadora' => $transportadora,
            'isEdit' => true
        ]);
    }
    
    public function update(): void {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('transportadoras');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        if ($this->transportadoraModel->update($id, $data)) {
            $this->flashMessage('success', 'Transportadora atualizada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar transportadora.');
        }
        
        $this->redirectTo('transportadoras');
    }
    
    public function delete(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('transportadoras');
            return;
        }
        
        if ($this->transportadoraModel->delete($id)) {
            $this->flashMessage('success', 'Transportadora deletada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao deletar transportadora.');
        }
        
        $this->redirectTo('transportadoras');
    }
}
