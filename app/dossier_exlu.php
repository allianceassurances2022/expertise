<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dossier_exlu extends Model
{
    protected $fillable = ['id', 'ref_sinistre'];
    protected $table = 'dossiers_exlu';

}


