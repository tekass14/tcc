<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    protected $table = 'face';

    protected $fillable = ['descriptor'];
}
