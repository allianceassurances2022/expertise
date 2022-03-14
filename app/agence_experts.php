<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class agence_experts extends Pivot
{
    //

    protected $fillable = ['agence_id', 'expert_id', 'STATUT'];

    /**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
public $incrementing = true;
protected $table = 'agence_experts';
}
