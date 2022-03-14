<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class FournituresChoc extends Pivot
{
    //

    protected $fillable = ['choc_id','description','piece_id','piece_id','nb','price','total','statut','user_id'];

    /**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
public $incrementing = true;
protected $table = 'fournitures_chocs';
}
