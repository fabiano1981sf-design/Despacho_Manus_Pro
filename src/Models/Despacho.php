<?php

namespace App\Models;

use App\Model;

class Despacho extends Model {
    protected string $table = 'despachos';
    protected array $fillable = ['numero', 'cliente_id', 'mercadoria_id', 'quantidade', 'status', 'data_saida', 'data_entrega', 'transportadora_id', 'observacoes'];
    
    public function findByStatus(string $status): array {
        return $this->findAllBy('status', $status);
    }
    
    public function findByCliente(int $clienteId): array {
        return $this->findAllBy('cliente_id', $clienteId);
    }
}
