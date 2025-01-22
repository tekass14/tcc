<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    
    use HasFactory;
    protected $fillable = ['nome', 'marca', 'modelo', 'preco', 'descricao', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function venda()
    {
        return $this->belongsToMany(Venda::class);
    }


}
