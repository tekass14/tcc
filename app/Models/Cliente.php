<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    
    protected $fillable = ['nome', 'cpf', 'endereco'];

    public function venda()
    {
        return $this->belongsToMany(Venda::class);
    }

}
