<?php

namespace App\Models;

use App\Model;

class Cliente extends Model {
    protected string $table = 'clientes';
    protected array $fillable = ['nome_razao', 'email', 'telefone', 'endereco', 'cidade', 'estado', 'cep', 'cnpj_cpf', 'tipo'];
    
    public function findByCnpjCpf(string $cnpjCpf): ?array {
        return $this->findBy('cnpj_cpf', $cnpjCpf);
    }
    
    public function findByEmail(string $email): ?array {
        return $this->findBy('email', $email);
    }
}
