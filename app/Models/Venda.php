<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['cliente_id', 'responsavel_id'];

    public function customer()
    {
        return $this->hasMany(Cliente::class);
    }

    public function products()
    {
        return $this->hasMany(Produto::class);
    }
}
