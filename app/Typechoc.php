<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typechoc extends Model
{
    protected $table = 'typechoc'; 
    protected $fillable = ['id','choc'];
}
