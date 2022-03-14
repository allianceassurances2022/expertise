<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Honoraire extends Model
{
	protected $fillable = ['id', 'expertise_id','libelle', 'nombre','montant'];
    protected $table = 'honoraire';

}
