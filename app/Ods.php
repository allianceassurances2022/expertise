<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ods extends Model
{
    protected $fillable = ['id', 'num_ods', 'ref_sinistre', 'agence', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'etat', 'status', 'code_expert', 'couleur','libelle_puissance','carburant'];
    protected $table = 'ods';




// hasOne($related, $foreignKey = null, $localKey = null)
public function rdv()
    {
        return $this->hasOne(rdv::class, 'ods_id', 'id')->withDefault(
        [
        'rdv_date' => 'Pas de RDV'
    	]);
    }
}