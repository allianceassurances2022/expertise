<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rdv extends Model
{
    //
    protected $table = 'rdv_ods'; 
    protected $fillable = [
        'autre_tel',
        'autre_mail',
        'observation',
        'rdv_date',
        'rdv_time',
        'lieu',
        'ods_id'
    ];
}
