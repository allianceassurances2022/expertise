<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeExpertise extends Model
{
    protected $fillable = ['id', 'libelle'];
    protected $table = 'type_expertise';
}
