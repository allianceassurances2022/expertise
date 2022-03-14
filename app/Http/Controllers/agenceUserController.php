<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\agence_user;
use App\agence;
use App\User;

class agenceUserController extends Controller
{

 public function __construct()
	 {
        $this->middleware('auth');
        $this->breadcrumb_lis_append(['title' => 'Utilisateur' , 'url' => 'utilisateur.index' , 'id' => '']);
        $this->Agence = new AgencesController();
    }

  public $Agence ;

    /**
     * Display a listing of the resource to DataTable.
     *
     * @return \Illuminate\Http\Response JSON
     */
  public function AgenceNonAffecteUserDataTable()
    {
       $user_id = Request()->user ;
       $agences = $this->AgenceAffecteNonUser($user_id , 'nonAffected') ;
        return  $this->aganceDataTable($agences);
    }

 public function AgenceAffecteUserDataTable()
    {
       $user_id = Request()->user ;
       $agences = $this->AgenceAffecteNonUser($user_id , 'Affected') ;
        return $this->aganceDataTable($agences);
    }

public function UserAffecteAgenceDataTable()
    {
       $id = Request()->id_agence ;
       // $userAgence =  \App\agence_user::select('user_id')->where('agence_id', $id )->get()->toArray();
       $users = User::select(['users.id','username','nom','prenom','agence_users.created_at'])
                            ->join('agence_users','user_id','=','users.id')
                            //->whereIn('users.id' , $userAgence)
                            ->where('agence_users.agence_id', $id)
                            ->where('users.previllege' ,'<>','expert');;
        return datatables()->of($users)->make(true);
    }

//
public function UserNonAffecteAgenceDataTable()
    {
      $id = Request()->id_agence ;
       // $userAgence =  \App\agence_user::select('user_id')->where('agence_id', $id )->get()->toArray();
    $usersList = User::select('users.id')
                            ->join('agence_users','user_id','=','users.id')
                            //->whereIn('users.id' , $userAgence)
                            ->where('agence_users.agence_id', $id)
                            ->where('users.previllege' ,'<>','expert')
                            ->get()
                            ->toArray();

       $users = User::select(['users.id','username','nom','prenom'])
                            ->where('users.previllege' ,'<>','expert')
                            ->whereNotIn('users.id' , $usersList);

        return datatables()->of($users)->make(true);
    }



public function AgenceAffecteNonUser($user_id , $type = 'Affected'){
    $agences = $this->Agence->getAllWithParam([['agence.DG','=', '00'],['agence.N_ANNEXE','=', 0] ] , ['agence.ID','agence.DG','directions.libelle as DR','agence.CODE','agence_type.type as TYPE_AGENCE','agence.TGVA','agence.STATUT','agence.CHEF_AGENCE','agence.EMAIL'], 'Builder') ;
    $agenceUser =  \App\agence_user::select('agence_id')->where('user_id', $user_id )->get()->toArray();
    if($type == 'Affected'){// si affecté
            $agences = $agences->whereIn('agence.id',  $agenceUser );
      }else{ // si non affecté
            $agences = $agences->whereNotIn('agence.id', $agenceUser );
      }

      return $agences;
    }


function aganceDataTable($agences){
        return datatables()->of($agences)
                            ->editColumn('STATUT', function($agence){
                                // return $agence->STATUT;
                                        return $agence->STATUT == '0' ? "<button class='btn btn-danger'><span class=' label label-danger'>Inactif</span> </button>"
                                                                      :"<button  class='btn btn-primary'><span class='primary label label-default'>Actif</span> </button>" ;
                                })
                            ->rawColumns(['STATUT'])
                           ->make(true);
}



public function index($user)
	{
    $user = \App\User::where('id',$user)->first();
		$agence_list=agence_user::where('user_id',$user->id)
                            ->leftJoin('agence', 'agence.id', '=', 'agence_users.agence_id')
                            ->leftJoin('directions','directions.code', '=', 'agence.DR')
                            ->select('agence.id','directions.libelle as dr','agence.code','agence_users.updated_at')->get();

    $breadcrumb_lis =  $this->breadcrumb_lis;
    $type_agence = \App\Agence_type::where('id', '>', 1)->get();
    $directions = \App\Direction::where('code' , '<>', '00')->get();
 	    return view('utilisateur.userAgence', compact('breadcrumb_lis', 'type_agence', 'directions', 'user', 'agence_list'));
	}

public function showUsersAgence($agence)
    {
      $agence = \App\Agence::where('id',$agence)->first();

      $breadcrumb_lis =  $this->breadcrumb_lis;

      return view('agence.agenceUser', compact('breadcrumb_lis','agence'));
    }


public function affecteAgenceUser(Request $request){
   $user_id = $request->id;
   $agenceListe = $request->affecteListe ;
   //dd($agenceListe);
   try {
         $user = \App\User::find($user_id );
         $user->agences()->attach($agenceListe);
         return response()->json(['etat'=>'success', 'message'=>'Les agences ont été attachées au utilisateur : '.$user->username ], 200);
   } catch (Exception $e) {
     return response()->json(['etat'=>'erreur', 'message'=>'Les agences ne sont pas été attachées au utilisateur : '.$user->username ,
                              'erreur' => $e->getMessage() ], 403);
   }

  }

public function desaffecteAgenceUser(Request $request){
   $user_id = $request->id;
   $agenceListe = $request->affecteListe ;
   // $agences=Agence::select('id')->whereIn('code',$agenceListe)->get()->pluck('id')->toArray();
   //dd($agences);
   //dd($agenceListe);

   try {
         $user = \App\User::find($user_id );
         $user->agences()->detach($agenceListe);
         return response()->json(['etat'=>'success', 'message'=>'Les agences ont été déttachées au utilisateur : '.$user->username ], 200);
   } catch (Exception $e) {
     return response()->json(['etat'=>'erreur', 'message'=>'Les agences ne sont pas été déttachées au utilisateur : '.$user->username ,
                              'erreur' => $e->getMessage() ], 403);
   }

  }





public function affecteUsersAgence(Request $request){
   $agence_id = $request->id_agence;
   $UserListe = $request->affecteListe ;
   //dd($agenceListe);
   try {
         $agence = \App\Agence::find($agence_id );
         $agence->users()->attach($UserListe);
         return response()->json(['etat'=>'success', 'message'=>'Les experts ont été attachées à l\'agence code : '.$agence->code ], 200);
   } catch (Exception $e) {
     return response()->json(['etat'=>'erreur', 'message'=>'Les experts ne sont pas été attachées à l\'agence code : '.$agence->code ,
                              'erreur' => $e->getMessage() ], 403);
   }

  }


  public function detachUsersAgence(Request $request){
   $agence_id = $request->id_agence;
   $UserListe = $request->affecteListe ;
   //dd($agenceListe);
   try {
         $agence = \App\Agence::find($agence_id );
         $agence->users()->detach($UserListe);
         return response()->json(['etat'=>'success', 'message'=>'Les experts ont été déttachées à l\'agence code : '.$agence->code ], 200);
   } catch (Exception $e) {
     return response()->json(['etat'=>'erreur', 'message'=>'Les experts ne sont pas été déttachées à l\'agence code : '.$agence->code ,
                              'erreur' => $e->getMessage() ], 403);
   }

  }



}
