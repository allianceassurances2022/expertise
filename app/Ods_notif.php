<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ods_notif extends Model
{
    protected $table = 'ods_notif';

     protected $fillable = [
        'id',
        'id_ods'
    ];
}
