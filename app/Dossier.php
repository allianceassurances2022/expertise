<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    protected $fillable = ['id', 'dr', 'agence', 'classe', 'branche', 'ref_sinistre', 'date_sinistre', 'matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail'];
    protected $table = 'dossiers';
}