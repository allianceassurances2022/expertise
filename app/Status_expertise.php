<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_expertise extends Model
{
    protected $fillable = ['id', 'libelle'];
    protected $table = 'status_expertise';
}
