<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;


class experts_details extends Pivot
// class agence_user extends Model
{
      protected $table = 'experts_details';
    //
     protected $fillable = ['id', 'code', 'adresse', 'wilaya_designation', 'wilaya_code', 'ville_designation', 'ville_code','telephone_1' , 'telephone_2', 'agerement_organisme', 'agrement_date_obtention','auto','risque_indu','transport','tva','nif','rib'];

/**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
public $incrementing = true;


}
