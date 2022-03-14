<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence_type extends Model
{
    //

    protected $fillable = ['ID', 'TYPE', 'LIBELLE'];
    protected $table = 'agence_type';
}