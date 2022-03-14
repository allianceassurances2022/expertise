<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $table = 'pieces'; 
    protected $fillable = [
        'id',
        'updated_at',
        'intitule',
        'created_at',
        'description',
        'cat_pieces',
        'etat'
    ];
}
