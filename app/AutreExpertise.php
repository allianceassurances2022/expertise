<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutreExpertise extends Model
{
    protected $fillable = ['id', 'valeur','service_epave', 'prejudice','expertise_id','description','observation','epave','taux_reforme'];
    protected $table = 'autre_expertise';
}
