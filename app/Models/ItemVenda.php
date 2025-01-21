<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $fillable = [
        'produto_id',  
        'venda_id',    
        'quantidade',  
    ];

    public function produto()
    {
        return $this->hasMany(Produto::class);
    }

    public function products()
    {
        return $this->hasMany(Venda::class);
    }
}
