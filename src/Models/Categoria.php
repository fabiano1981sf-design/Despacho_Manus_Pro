<?php

namespace App\Models;

use App\Model;

class Categoria extends Model {
    protected string $table = 'categorias';
    protected array $fillable = ['nome', 'descricao'];
}
