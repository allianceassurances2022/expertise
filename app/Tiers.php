<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiers extends Model
{
    protected $fillable = ['id', 'ref_sinistre', 'tiers', 'nom', 'prenom', 'date_naissance', 'matricule', 'marque', 'model'];
    protected $table = 'tiers';
}
