<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageErreur extends Model
{
    protected $table = 'messageerreur';
    protected $fillable = [
        'libelle',
        'type',
    ];
}
