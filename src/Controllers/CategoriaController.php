<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Categoria;

class CategoriaController extends Controller {
    
    private Categoria $categoriaModel;
    
    public function __construct() {
        $this->categoriaModel = new Categoria();
    }
    
    public function index(): void {
        $categorias = $this->categoriaModel->all();
        $this->render('_categorias', ['categorias' => $categorias]);
    }
    
    public function create(): void {
        $this->render('_categorias_form', []);
    }
    
    public function store(): void {
        $data = $this->sanitize($_POST);
        
        $rules = [
            'nome' => 'required|min:3',
        ];
        
        $errors = $this->validate($data, $rules);
        
        if (!empty($errors)) {
            $this->flashMessage('danger', 'Verifique os erros no formulário.');
            $this->redirectTo('categorias');
            return;
        }
        
        if ($this->categoriaModel->create($data)) {
            $this->flashMessage('success', 'Categoria criada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao criar categoria.');
        }
        
        $this->redirectTo('categorias');
    }
    
    public function edit(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->redirectTo('categorias');
            return;
        }
        
        $categoria = $this->categoriaModel->find($id);
        
        if (!$categoria) {
            $this->flashMessage('danger', 'Categoria não encontrada.');
            $this->redirectTo('categorias');
            return;
        }
        
        $this->render('_categorias_form', [
            'categoria' => $categoria,
            'isEdit' => true
        ]);
    }
    
    public function update(): void {
        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('categorias');
            return;
        }
        
        $data = $this->sanitize($_POST);
        
        if ($this->categoriaModel->update($id, $data)) {
            $this->flashMessage('success', 'Categoria atualizada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao atualizar categoria.');
        }
        
        $this->redirectTo('categorias');
    }
    
    public function delete(): void {
        $id = $_GET['id'] ?? null;
        
        if (!$id) {
            $this->flashMessage('danger', 'ID inválido.');
            $this->redirectTo('categorias');
            return;
        }
        
        if ($this->categoriaModel->delete($id)) {
            $this->flashMessage('success', 'Categoria deletada com sucesso!');
        } else {
            $this->flashMessage('danger', 'Erro ao deletar categoria.');
        }
        
        $this->redirectTo('categorias');
    }
}
