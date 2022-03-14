<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ods_etat extends Model
{
    protected $table = 'ods_etat';

     protected $fillable = [
        'id',
        'id_ods',
        'id_status',
    ];
}
