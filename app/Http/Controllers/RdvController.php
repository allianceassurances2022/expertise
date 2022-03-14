<?php

namespace App\Http\Controllers;

use App\rdv;
use Illuminate\Http\Request;

class RdvController extends Controller
{
    
// constructeur
public function __construct()
	{
	    $this->middleware('auth');
	    $this->breadcrumb_lis_append(['title' => 'RDV' , 'url' => 'rdv.creer', 'id' => '']);
	} 
	  
// ajouter un RDV
 public function creer()
    {
        $breadcrumb_lis =  $this->breadcrumb_lis() ;
        return view('rdv.ajouter', compact('breadcrumb_lis'));
    }


// emregistrer un RDV
 public function store(Request $request)
    {
        
        $rdv = rdv::updateOrCreate(
                        ['ods_id' => $request->ods_id, 'id' => $request->id],
                        $request->all()
                    );
        $msg = 'les modifications ont été enregistés';
        $breadcrumb_lis =  $this->breadcrumb_lis();
        return redirect()->route('rdv.creer')->withSuccess($msg);
    }

//dataTable RDV 
    public function index_RDV_table()
    {
        // $roles = Role::select('name','id');
        // return datatables()->of($roles)
        //     ->addColumn('action', function ($data) {
        //             return '
        // <a href="' . route('role.edit', $data->id) . '" class="btn btn-xs btn-info" title="Modifier">Modifier</a>
        // ';

        //     })
        //     ->make(true);
    }
}
