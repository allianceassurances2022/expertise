<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FraisHonoraire extends Model
{
    protected $fillable = ['id', 'libelle','montant'];
    protected $table = 'frais_honoraire';
}
