<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    
    use hasFactory;
    protected $fillable = ['nome'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

}
