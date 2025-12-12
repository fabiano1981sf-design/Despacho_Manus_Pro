<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Mercadoria;
use App\Models\Categoria;

class MercadoriaController extends Controller {
    
    private Mercadoria $mercadoriaModel;
    private Categoria $categoriaModel;
    
    public function __construct() {
        $this->mercadoriaModel = new Mercadoria();
        $this->categoriaModel = new Categoria();
    }
    
    public function index(): void {
        $mercadorias = $this->mercadoriaModel->all();
        $this->render('_mercadorias', ['mercadorias' => $mercadorias]);
    }
    
    public function create(): void {
        $categorias = $this->categoriaModel->all();
        $this->render('_mercadorias_form', ['categorias' => $categorias]);
    }
    
    public function store(): void {
        $data = $this->sanitize($_POST);
        
        $rules = [
            'nome' => 'required|min:3',
            'sku' => 'required|min:2',
            'categoria_id' => 'required',
            'quantidade_estoque' => 'required',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('mercadorias');
            return;
        }
        
        // Verifica se SKU já existe
        $existing = $this->mercadoriaModel->findBySku($data['sku']);
        if ($existing) {
            $this->flashMessage('danger', 'SKU já existe no sistema.');
            $this->redirectTo('mercadorias');
            return;
        }
        
        if ($this->mercadoriaModel->create($data)) {
            $this->flashMessage('success', 'Mercadoria criada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao criar mercadoria.');
        }
        
        $this->redirectTo('mercadorias');
    }
    
    public function edit(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->redirectTo('mercadorias');
            return;
        }
        
        $mercadoria = $this->mercadoriaModel->find($id);
        $categorias = $this->categoriaModel->all();
        
        if (!$mercadoria) {
            $this->flashMessage('danger', 'Mercadoria não encontrada.');
            $this->redirectTo('mercadorias');
            return;
        }
        
        $this->render('_mercadorias_form', [
            'mercadoria' => $mercadoria,
            'categorias' => $categorias,
            'isEdit' => true
        ]);
    }
    
    public function update(): void {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('mercadorias');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        if ($this->mercadoriaModel->update($id, $data)) {
            $this->flashMessage('success', 'Mercadoria atualizada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar mercadoria.');
        }
        
        $this->redirectTo('mercadorias');
    }
    
    public function delete(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('mercadorias');
            return;
        }
        
        if ($this->mercadoriaModel->delete($id)) {
            $this->flashMessage('success', 'Mercadoria deletada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao deletar mercadoria.');
        }
        
        $this->redirectTo('mercadorias');
    }
}
