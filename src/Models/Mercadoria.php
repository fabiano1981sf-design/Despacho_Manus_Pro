<?php

namespace App\Models;

use App\Model;

class Mercadoria extends Model {
    protected string $table = 'mercadorias';
    protected array $fillable = ['nome', 'sku', 'categoria_id', 'quantidade_estoque', 'preco_unitario', 'descricao'];
    
    public function findBySku(string $sku): ?array {
        return $this->findBy('sku', $sku);
    }
    
    public function findByCategoria(int $categoriaId): array {
        return $this->findAllBy('categoria_id', $categoriaId);
    }
}
