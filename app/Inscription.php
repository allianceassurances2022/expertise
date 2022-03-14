<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table = 'inscription';
    public $timestamps = false;
    protected $fillable = [
        'id', 'nbr'
    ];
}
