<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agence_type;

class Agence extends Model
{
    // protected $fillable = ['code','libelle','chef_agence','tel','statut','type_agence','direction','email','long','lat' ];

 protected $fillable = ['DG',    'DR',    'CODE',    'N_ANNEXE',    'TYPE_AGENCE',    'TGVA',    'STATUT',    'CHEF_AGENCE',    'EMAIL'];
    
    protected $table = 'agence';
    
    public $timestamps = false;

/*
|relation
        hasMany($related, $foreignKey = null, $localKey = null)
*/
    public function gere(){
        return $this->hasMany(Agence::class, 'TGVA', 'code');
    }

//
//
  public function typeAgence()
    {
        return $this->belongsTo(Agence_type::class, 'TYPE_AGENCE', 'id')->withDefault();
    }

 public function drAgence()
    {
        return $this->belongsTo(Direction::class, 'DR', 'code')->withDefault();
    }

    /**
     * The users that belong to the AGENCE.
     */
    public function users()
    {
        return $this->belongsToMany('App\User','agence_users', 'agence_id','user_id')
                        ->using('App\agence_user')
                        ->withPivot(['STATUT',
                            'created_at',
                            'updated_at'
                        ]);
    }

    public function experts()
    {
        return $this->belongsToMany('App\User','agence_experts', 'agence_id','expert_id')
                        ->using('App\agence_experts')
                        ->withPivot(['STATUT',
                            'created_at',
                            'updated_at'
                        ]);
    }



// attribute 

   /*
    |------------------------------------------------------------------------------------
    | Attributes  Get 
    |------------------------------------------------------------------------------------
    */
   
    /*
    | return 
    */
    // public function getTypeAgenceAttribute($value='')
    // {
    //     return $this->typeAgence()->libelle;
    // } 

}
