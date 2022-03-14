<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumExpertise extends Model
{
    protected $table = 'num_expertise';

     protected $fillable = [
        'id',
        'id_expertise',
        'num_pv',
        'code_expert',
        'code_agence',
    ];
}