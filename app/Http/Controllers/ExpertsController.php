<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\experts_details;


class ExpertsController extends Controller
{
    

public function __construct()
{
	$this->middleware('auth');
    $this->breadcrumb_lis_append(['title' => 'Experts' , 'url' => 'expert.index', 'id' => '' ]);        
	}

	public function index()
	{
		$breadcrumb_lis =  $this->breadcrumb_lis ;
	    return view('expert.index', compact('breadcrumb_lis'));
	}
	public function ajout()
	{
		$breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Ajouter' , 'url' => 'expert.ajouter', 'id' => '' ]) ;
	    return view('expert.ajout', compact('breadcrumb_lis'));
	}
    
    public function index_table()
    {
            $users = User::select('users.id','users.username', 'users.nom', 'users.prenom', 'users.etat','users.email', 'experts_details.code', 'experts_details.wilaya_designation', 'experts_details.telephone_1', 'experts_details.telephone_2','experts_details.agerement_organisme', 'experts_details.agrement_date_obtention')->leftJoin('experts_details', 'experts_details.id', '=', 'users.id')->where('previllege','expert');
            return datatables()->of($users)
                ->editColumn('etat', function($data){
                    // return $agence->STATUT;
                    return $data->etat == '0' ? "<button class='btn btn-sm btn-danger'><span class=' label label-danger'><i class='typcn typcn-thumbs-down'></i></span> </button>"
                        :"<button  class='btn btn-sm btn-primary'><span class='primary label label-default'><i class='typcn typcn-thumbs-up'></i> </span> </button>" ;
                })
                ->addColumn('action', function ($data) {
                    if ($data->etat===1){
                    return '
        <a href="' . route('utilisateur.role.edit', $data->id) . '" class="btn btn-sm btn-success" title="Role"><i class=\'typcn typcn-th-large\'></i></a>
        <a href="' . route('experts.expertAgence', $data->id) . '" class="btn btn-sm btn-success" title="affectation et Reaffectation agences"><i class=\'mdi mdi-home\'></i></a>';
        }elseif ($data->etat===0) {
                    return '
        <a href="' . route('utilisateur.role.edit', $data->id) . '" class="btn btn-sm btn-success" title="Role"><i class=\'typcn typcn-th-large\'></i></a>
        <a href="' . route('experts.expertAgence', $data->id) . '" class="btn btn-sm btn-success" title="affectation et Reaffectation agences"><i class=\'mdi mdi-home\'></i></a>';
                    };

                })
                ->rawColumns(['etat','action'])
            ->make(true);
    }
}
