<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditAction extends Model
{
    protected $fillable = ['id', 'user','action','libelle'];
    protected $table = 'audite_action';

    public function audit(String $user, String $action, String $libelle)
    {
    	AuditAction::create([
    		'user'=> $user,
    		'action'=> $action,
    		'libelle'=> $libelle
    	]);
    }

}