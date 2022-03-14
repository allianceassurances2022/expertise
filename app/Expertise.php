<?php

namespace App;

use App\Ods;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $fillable = ['id', 'id_ods','status','MTC_expertise','MHT_expertise','type','id_parent','num_expertise','model','code','date_expertise','heure_expertise','lieu_expertise','couleur','valeur_venal','taux_resp','motif_rejet','observation'];
    protected $table = 'expertise';

/*
|relation
        hasMany($related, $foreignKey = null, $localKey = null)
*/
        //($related, $foreignKey = null, $localKey = null)
    public function ods(){
        return $this->hasOne(Ods::class, 'id', 'id_ods');
    }


}