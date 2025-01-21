<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    
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
