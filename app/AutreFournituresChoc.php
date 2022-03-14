<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutreFournituresChoc extends Model
{
    

    protected $fillable = ['id','choc_id','libelle','nb','price','total','statut','user_id'];

    /**
 * Indicates if the IDs are auto-incrementing.
 *
 * @var bool
 */
    public $incrementing = true;
    protected $table = 'autre_fournitures_chocs';
}
