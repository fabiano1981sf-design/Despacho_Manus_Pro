<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Despacho;
use App\Models\Cliente;
use App\Models\Mercadoria;
use App\Models\Transportadora;

class DespachoController extends Controller {
    
    private Despacho $despachoModel;
    private Cliente $clienteModel;
    private Mercadoria $mercadoriaModel;
    private Transportadora $transportadoraModel;
    
    public function __construct() {
        $this->despachoModel = new Despacho();
        $this->clienteModel = new Cliente();
        $this->mercadoriaModel = new Mercadoria();
        $this->transportadoraModel = new Transportadora();
    }
    
    public function index(): void {
        $despachos = $this->despachoModel->all();
        $this->render('_despachos', ['despachos' => $despachos]);
    }
    
    public function create(): void {
        $clientes = $this->clienteModel->all();
        $mercadorias = $this->mercadoriaModel->all();
        $transportadoras = $this->transportadoraModel->all();
        
        $this->render('_despachos_form', [
            'clientes' => $clientes,
            'mercadorias' => $mercadorias,
            'transportadoras' => $transportadoras,
        ]);
    }
    
    public function store(): void {
        $data = $this->sanitize($_POST);
        
        $rules = [
            'numero' => 'required',
            'cliente_id' => 'required',
            'mercadoria_id' => 'required',
            'quantidade' => 'required',
            'status' => 'required',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('despachos');
            return;
        }
        
        if ($this->despachoModel->create($data)) {
            $this->flashMessage('success', 'Despacho criado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao criar despacho.');
        }
        
        $this->redirectTo('despachos');
    }
    
    public function edit(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->redirectTo('despachos');
            return;
        }
        
        $despacho = $this->despachoModel->find($id);
        $clientes = $this->clienteModel->all();
        $mercadorias = $this->mercadoriaModel->all();
        $transportadoras = $this->transportadoraModel->all();
        
        if (!$despacho) {
            $this->flashMessage('danger', 'Despacho não encontrado.');
            $this->redirectTo('despachos');
            return;
        }
        
        $this->render('_despachos_form', [
            'despacho' => $despacho,
            'clientes' => $clientes,
            'mercadorias' => $mercadorias,
            'transportadoras' => $transportadoras,
            'isEdit' => true
        ]);
    }
    
    public function update(): void {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('despachos');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        if ($this->despachoModel->update($id, $data)) {
            $this->flashMessage('success', 'Despacho atualizado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar despacho.');
        }
        
        $this->redirectTo('despachos');
    }
    
    public function delete(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('despachos');
            return;
        }
        
        if ($this->despachoModel->delete($id)) {
            $this->flashMessage('success', 'Despacho deletado com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao deletar despacho.');
        }
        
        $this->redirectTo('despachos');
    }
}
