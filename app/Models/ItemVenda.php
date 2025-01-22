<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemVenda extends Model
{

    use HasFactory;
    protected $fillable = [
        'produto_id',  
        'venda_id',    
        'quantidade',  
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function products()
    {
        return $this->belongsTo(Venda::class);
    }
}
