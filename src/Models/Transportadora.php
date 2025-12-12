<?php

namespace App\Models;

use App\Model;

class Transportadora extends Model {
    protected string $table = 'transportadoras';
    protected array $fillable = ['nome', 'cnpj', 'telefone', 'email', 'endereco'];
}
