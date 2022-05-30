<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    //La propriété $fillable autorise le mass assignment. pour le model et pour l'insertion en masse de données en BDD
    protected $fillable = [
        'title',
        'content',
        'cocktail_id'
    ];


    # La fction pr créer la relation avec le model Cocktail aura le nom de la propriéte
    public function cocktail()
    {
        // Ce coté de la relation
        return $this->belongsTo('App\Models\Cocktail');
    }
}
