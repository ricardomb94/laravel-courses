<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coctail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'price'
    ];

    public function plats ()
    {
        return $this->hasMany('App\Models\Plats');
    }
}
