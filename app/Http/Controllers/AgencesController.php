<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agence;

class AgencesController extends Controller
{
 	public function __construct()
	{
    $this->middleware('auth');
        $this->breadcrumb_lis_append(['title' => 'Agence' , 'url' => 'agence.index' , 'id' => '']);        
    }

    /**
     * Display a listing of the resource to DataTable.
     *
     * @return \Illuminate\Http\Response JSON
     */

    public function testAjax(Request $request){
        return response()->json($request->all(), 200);
    }

    
    public function indexAgenceDataTable()
    {
        // $agences = Agence::get();
        //return view('Agence.index', compact('agence')); 
        //get All agences avec des paramètres : Condition=$where ,, Select=$colomn,  type de resultat = $type in { null, collection, Array, Builder}
        // ['DG','DR','CODE','TYPE_AGENCE','TGVA','STATUT','CHEF_AGENCE','EMAIL']
        $agences = $this->getAllWithParam([ ['agence.DG','=', '00'],['agence.N_ANNEXE','=', 0] ] , ['agence.ID','agence.DG','directions.libelle as DR','agence.CODE','agence_type.type as TYPE_AGENCE','agence.STATUT','agence.CHEF_AGENCE','agence.EMAIL'] , 'Builder') ;

        //        $agences = Agence::select(['id','DG','DR','CODE'])->with('users', 'experts')->get();
        //  // $agence = $agences->
        // return $agences; //->users()->get();


        return datatables()->of($agences)
                            
                            ->editColumn('STATUT', function($agence){
                                // return $agence->STATUT;
                                        return $agence->STATUT == '0' ? "<button class='btn btn-danger'><span class=' label label-danger'>Inactif</span> </button>" 
                                                                      :"<button  class='btn btn-primary'><span class='primary label label-default'>Actif</span> </button>" ;
                                })
                            ->addColumn('action', function ($data) {
                    return '<a href="'.route('agence.modifier', $data->ID).'" class="btn btn-action btn-sm btn-success" title="modifier Agence"><i class="typcn typcn-edit"></i></a> <a href="'.route('agences.show', $data->ID).'" class="btn btn-action btn-sm btn-success" title="Detail"><i class="typcn typcn typcn-plus"></i></a>';})->rawColumns(['STATUT', 'action'])->make(true);
    }
  

	public function index()
	{
		 $breadcrumb_lis =  $this->breadcrumb_lis ;
         $type_agence = \App\Agence_type::where('id', '>', 1)->get();
         $directions = \App\Direction::where('code' , '<>', '00')->get();
 	    return view('agence.index', compact('breadcrumb_lis', 'type_agence', 'directions'));
	}

  public function show($agence)
    {
        // $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Détail' , 'url' => 'agence.index']) ;
         $breadcrumb_lis =  $this->breadcrumb_lis ;
        $agence = Agence::where('id',$agence)->with('typeAgence','drAgence')->get()->first();
        return view('agence.detail',compact('agence','breadcrumb_lis'));
        //
    }

	public function ajout()
    {   $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Ajouter' , 'url' => 'agence.ajouter', 'id' => '']) ;
 		
         $type_agence = \App\Agence_type::where('id', '>', 1)->get();
         $directions = \App\Direction::where('code' , '<>', '00')->get();
        return view('agence.ajouter', compact('breadcrumb_lis', 'type_agence', 'directions'));
    }

    public function edit($id)
    {
        $breadcrumb_lis =  $this->breadcrumb_lis_append( ['title' => 'Modifier' , 'url' => 'agence.ajouter', 'id' => '']) ;

        $agence = Agence::where('id',$id)->get()->first();
        return view('agence.modifier',compact('agence'));
    }

    public function store(Request $request)
    {
//['DR','CODE','TYPE_AGENCE','TGVA','STATUT','CHEF_AGENCE','EMAIL']
        $rules = array(
            'code_agence' => 'bail|required|integer|digits:5|unique:agence,code',
            'chef_agence' => 'bail|string|max:190',
            'statut' => 'nullable|in:true,false,1,0,on,off',
            'type_agence'  => 'bail|required|numeric|exists:agence_type,id',
            'direction'   => 'bail|required|string|max:2|exists:directions,code',
            'email_agence'    => 'bail|nullable|email|max:190',
            
        );

        $data = [
            'CODE' => $request->code_agence,
            'CHEF_AGENCE' => $request->chef_agence,
            'STATUT' => $request->statut,
            'TYPE_AGENCE' => $request->type_agence,
            'DR' => $request->direction,
            'EMAIL' => $request->email_agence,
            'TGVA' => $request->code_agence,
            
        ];

        if($this->validate($request, $rules)){
            $this->creatAgence($data);
            return redirect()->route('agence.ajouter')
                             ->withSuccess("L'ajout a été effectué avec succès");
        }
        else{
            //Agence::create($data);
            return redirect()->route('agence.ajouter')
                             ->withError("L'ajout été effectué veuillez corriger les champs ci-dessous");   
        }
        
	}



//""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

//Creat agence avec des data
//['DG' =00, 'DR','CODE','N_ANNEXE'=0, 'TYPE_AGENCE','TGVA', 'STATUT'=1, 'CHEF_AGENCE', 'EMAIL']
public function creatAgence(array $data = [] ){
    return Agence::create($data);

}

//Update agence $ID  avec des data
//['DG' , 'DR','CODE','N_ANNEXE', 'TYPE_AGENCE','TGVA', 'STATUT', 'CHEF_AGENCE', 'EMAIL']
public function updateAgence(Agence $agence ,array $data = [] ){
    return $agence->update($data);

}

public function update(Request $request, $id)
    {
         $rules = array(
            'chef_agence' => 'bail|string|max:190',
            'statut' => 'nullable|in:true,false,1,0,on,off',
            'type_agence'  => 'bail|required|numeric|exists:agence_type,id',
            'direction'   => 'bail|required|string|max:2|exists:directions,code',
            'email_agence'    => 'bail|nullable|email|max:190',
            
        );

        $data = [
            'CHEF_AGENCE' => $request->chef_agence,
            'STATUT' => $request->statut,
            'TYPE_AGENCE' => $request->type_agence,
            'DR' => $request->direction,
            'EMAIL' => $request->email_agence,
            'TGVA' => $request->code_agence,
            
        ];

        if($this->validate($request, $rules)){
          Agence::find($id)->update($data);
            return redirect()->route('agence.index')
                             ->withSuccess("La modification a été effectuée avec succès");
        }
        else{
            //Agence::create($data);
            return redirect()->route('agence.index')
                             ->withError("La modification n'a pas été effectuée veuillez corriger les champs ci-dessous");   
        }
    }


// $code est le code d'agence a avoir qui la gére
// $colomn est les colomn de select, par defaut '*'
// $type le type de resultat (Collection Agence ou Array si $type==Array)
// get les informations de l'agnce qui gére l'agence avec le code = $Code
// si le TGVA == CODE alors s'autogére donc la reponse est l'agence 
// si TGVA != CODE alors l'agence(code=$CODE) a cesser de fonctionner et sa gestion a été transféré à l'agence(code=TGVA)
//return d'une Agence sous form d'une Collection ou Array
public function getGereParAgence( $code , array $colomn = ['*'] , $type = null) {
     $agence = Agence::where('agence.CODE', Agence::select('agence.TGVA')
                                          ->where('agence.CODE',$code)
                                          ->first()
                                          ->tgva)
                      ->where('agence.STATUT', 1)
                      ->where('agence.N_ANNEXE', 0)
                      ->select($colomn);
    
    if(!empty($type)) {
        if ($type == 'Array') {  
              return $agence->first()->toArray();
          }
        if ($type == 'Builder') {  
              return $agence;
          }
     }     
    return $agence->first();
}

// $code est le code d'agence a avoir la liste des agence qui les géres 
// $colomn est les colomn de select, par defaut '*'
//return une collection des agences qui sont gére par l'agence code = $code
public function getAgencesGere( $code , array $colomn =['*'] ){
     $agence = Agence::where('agence.TGVA',$code)
                      ->orderBy('agence.STATUT' , 'desc')
                      ->orderBy('agence.N_ANNEXE')
                      ->select($colomn);
 return $agence->get();
}

//get All Active agences avec selected $colomn
public function getAll(array $colomn = ['*'], $type=null){
  return $this->getAllWithParam( [['agence.STATUT','=',1]] , $colomn, $type);
}
//get All Actif/Inactif agences avec selected $colomn
public function getAllWithInactif(array $colomn = ['*'] ,$type = null){
  return $this->getAllWithParam( [ ['agence.DG','=', '00'],['agence.N_ANNEXE','=', 0] ]  , $colomn, $type);
}
//get All Inactif agences avec selected $colomn
public function getAllInactif(array $colomn = ['*'] ,$type = null){
  return $this->getAllWithParam( [['agence.STATUT','=',0]] , $colomn, $type);
}


//get All agences de la DR avec selected $colomn
public function getAllAgenceDr($DR , array $colomn = ['*'] ,$type= null){
  return $this->getAllWithParam( [['agence.DR','=',$DR],['agence.STATUT','=',1]] , $colomn, $type);
}
//get All agences Actif/Inactif de la DR avec selected $colomn
public function getAllAgenceDrWithInactif($DR , array $colomn = ['*'] ,$type= null){
  return $this->getAllWithParam( [['agence.DR','=',$DR], ['agence.DG','=', '00'],['agence.N_ANNEXE','=', 0] ]  , $colomn, $type);
}
//get All agences Inactif de la DR avec selected $colomn
public function getAllAgenceDrInactif($DR , array $colomn = ['*'] ,$type= null){
  return $this->getAllWithParam( [['agence.DR','=',$DR] ,['agence.STATUT','=',0] ] , $colomn, $type);
}


//get All agences avec des paramètres : Condition=$where ,, Select=$colomn,  type de resultat = $type in { null, collection, Array, Builder}
public function getAllWithParam(array $where = [] , array $colomn = ['*'] , $type = null){


  $agences = Agence::where($where)
                     ->select($colomn)
                     ->join('agence_type','agence.type_agence','=','agence_type.id')
                     ->join('directions','agence.dr','=','directions.code');
  if (empty($type) || $type == 'collection' ) { 
      // return par defaut une collection d'agences
      return $agences->get(); 
    }elseif ($type == 'Array') {
      // return un tableau d'agences 
      return  $agences->get()->toArray();
    }elseif ($type == 'Builder') {
      //return un query Builder 
      return $agences;
    }else{
      //par defaut return une collection
      return $agences->get();
    }
                
}

function agenceTable(Request $req) {
    if (!isset($req->direction) || $req->direction =='00' ) {
      return $this->getAllWithInactif( ['agence.CODE'] );
    } 
    return $this->getAllAgenceDrWithInactif($req->direction , ['agence.CODE']);
}
}
