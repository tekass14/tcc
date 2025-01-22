<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    
    use HasFactory;
    protected $fillable = ['nome', 'cpf', 'endereco'];

    public function venda()
    {
        return $this->belongsToMany(Venda::class);
    }

}
