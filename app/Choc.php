<?php

namespace App;

use App\Expertise;
use Illuminate\Database\Eloquent\Model;

class Choc extends Model
{
    protected $fillable = ['id', 'expertise_id', 'choc', 'description', 'main_oeuvre', 'immobilisation','Autres', 'assure_fautif', 'suspicion_fraude', 'vol', 'remarque', 'etat','total_fourniture','non_tva','tva','MTC_choc','vetuste','vetuste_pneumatique','valide_at'];

    protected $table = 'chocs';


public function fournitures()
    {
        return $this->belongsToMany('App\Piece','fournitures_chocs', 'choc_id','piece_id')
                        ->using('App\FournituresChoc')
                        ->withPivot(['choc_id','description','piece_id','nb','price',
                        			 'total','statut','user_id',
		                             'created_at','updated_at'
		                        ]);
    }

public function autrefournitures()
    {
        return $this->hasMany('App\AutreFournituresChoc','choc_id','id');
    }

public function expertise(){
        return $this->hasOne(Expertise::class, 'id', 'expertise_id');
    }

}
