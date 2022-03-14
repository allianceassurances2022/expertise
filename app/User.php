<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'nom',
        'prenom',
        'email',
        'password',
        'etat',
        'previllege',
        'profil_update',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 
    

    public static function boot() {
        parent::boot();
        static::created(function (User $user) {
            // echo "successfully fired";   //this does not get echoed
             $user->syncRoles($user->previllege);  
        });
    }
   /**
     * The agences that belong to the User.
     */

    
    public function agences()
    {
        return $this->belongsToMany('App\Agence','agence_users','user_id', 'agence_id')
                        ->using('App\agence_user')
                        ->withPivot(['STATUT',
                            'created_at',
                            'updated_at'
                        ]);
    }


    /**
     * The agences that belong to the Expert.
     */
    public function expertAgences()
    {
        return $this->belongsToMany('App\Agence','agence_experts','expert_id', 'agence_id')
                        ->using('App\agence_experts')
                        ->withPivot(['STATUT',
                                    'created_at',
                                    'updated_at'
                                    ]);
    }




}
