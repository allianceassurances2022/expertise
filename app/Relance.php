<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relance extends Model
{
	protected $fillable = ['id', 'id_ods','date_relance', 'remarque'];
    protected $table = 'relances';


}
