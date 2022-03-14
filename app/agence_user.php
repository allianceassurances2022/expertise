<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;


class agence_user extends Pivot
// class agence_user extends Model
{
      protected $table = 'agence_users';
    //
     protected $fillable = ['agence_id', 'user_id', 'STATUT'];


/**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
public $incrementing = true;


}
