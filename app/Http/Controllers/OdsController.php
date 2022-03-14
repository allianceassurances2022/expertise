<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\experts_details;
use App\Direction;
use App\Agence;
use App\dossier;
use App\tiers;
use App\Ods;
use App\Status_ods;
use App\MessageErreur;
use App\Relance;
use App\Notifications\RelanceOds;
use App\Notifications\EditOds;
use App\Notifications\AddOds;
use Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OdsController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth');
    }

    public function creer()
    {
        $users = User::select('users.id','code','nom')->where('previllege','expert')->leftJoin('experts_details', 'users.id', '=', 'experts_details.id')->get();
        //dd($users);
        $directions = Direction::all();
        $this->breadcrumb_lis_append(['title' => 'Creer ODS' , 'url' => 'ods.creer' , 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('ODS.ajouter', compact('breadcrumb_lis','directions', 'users'));
    }


    public function modifier()
    {
        $users = User::select('users.id','code','nom', 'prenom')->where('previllege','expert')->leftJoin('experts_details', 'users.id', '=', 'experts_details.id')->get();
        $directions = Direction::all();
        $this->breadcrumb_lis_append(['title' => 'Modifier ODS' , 'url' => 'ods.creer' , 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('ODS.modifier', compact('breadcrumb_lis','directions','users'));
    }

    public function annuler_supprimer()
    {
        $directions = Direction::all();
    	$this->breadcrumb_lis_append(['title' => 'Annuler ODS' , 'url' => 'ods.annuler_supprimer', 'id' => '' ]);
    	$breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('ODS.annuler_supprimer', compact('breadcrumb_lis','directions'));
    }

    public function experts_table()
    {

            $users = User::select('users.id','code','nom','prenom')->where('previllege','expert')->leftJoin('experts_details', 'users.id', '=', 'experts_details.id');

            return datatables()->of($users)->addColumn('detail', function ($data) {
                    return '<a href="'.route('utilisateur.modifier',$data->id).'" class="btn btn-sm btn-primary" title="Modifier"><i class="typcn typcn-user-outline"></i> </a>';

        })->rawColumns(['detail'])->make(true);
    }

    public function agenceTable(Request $req)
    {
        $agences =getAllAgenceDr($req->direction)->get();
        return response()->json($agences);
    }

    public function dossierTable(Request $request)
    {

            $code_agence=Auth::user()->agences()->get(array('code'));

            $explode_id = collect (json_decode($request->recherche, true));
            $x=$explode_id->pluck('value','name');

            if(isset($x['recherche_direction'])){
                        // table de conditions de la recherche     //  dr ,agence ,branche ,status
                $conditionWhere = [];

                if ($x['date_debut']!="") {
                        $conditionWhere[] =  ['date_sinistre' , '>=' ,  $x['date_debut'] ] ;
                    }
                 if ($x['date_fin']!="") {
                        $conditionWhere[] =  ['date_sinistre' , '<=',  $x['date_fin'] ] ;
                    }

                //  Region
                 if ($x['recherche_direction']!="00") {
                           $conditionWhere[] =  ['dr' , '=',  $x['recherche_direction'] ] ;
                }

                //  Agence
                if($x['recherche_agence']!="-1"){
                    $conditionWhere[] =  ['agence' , '=',  $x['recherche_agence'] ] ;
                }

                if (Auth::user()->previllege==="expert" or Auth::user()->previllege==="agence" or Auth::user()->previllege==="dr"){
                $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')->where($conditionWhere)
                  ->whereIn('agence',$code_agence->toArray());
                }
                if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
                    $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')->where($conditionWhere);
                }
            }

            else if(isset($x['dossier_sinistre_r'])){
                if (Auth::user()->previllege==="expert" or Auth::user()->previllege==="agence" or Auth::user()->previllege==="dr"){
                $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')->where('ref_sinistre', 'like', '%'.$x['dossier_sinistre_r'].'%')
                ->whereIn('agence',$code_agence->toArray());
                }
                if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
                    $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')->where('ref_sinistre', 'like', '%'.$x['dossier_sinistre_r'].'%');
                }
            }

            else if(isset($x['dossier_police_r'])){
                if (Auth::user()->previllege==="expert" or Auth::user()->previllege==="agence" or Auth::user()->previllege==="dr"){
                $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')->where('ref_police', 'like', '%'.$x['dossier_police_r'].'%')
                ->whereIn('agence',$code_agence->toArray());
                }
                if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
                    $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')->where('ref_police', 'like', '%'.$x['dossier_police_r'].'%');
                }
            }

            else{
                if (Auth::user()->previllege==="expert" or Auth::user()->previllege==="agence" or Auth::user()->previllege==="dr"){
                $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail')
                ->whereIn('agence',$code_agence->toArray());
                }
                if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
                    $dossier = dossier::select('ref_sinistre','date_sinistre','matricule', 'marque', 'model', 'ref_police', 'date_effet', 'date_expiration','num_serie', 'assure', 'detail');
                 }
            }

            return datatables()->of($dossier)->addColumn('detail', function ($data) {
                    return '<button class="voir-detail btn btn-sm btn-primary" title="Voir dÃ©tail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </button>';
            })->rawColumns(['detail'])
            ->make(true);
    }

    public function tiersTable(Request $request)
    {

            $tiers = tiers::select('ref_sinistre','tiers','nom', 'prenom', 'date_naissance', 'matricule', 'marque', 'model')
            ->where('ref_sinistre',$request->ref_sin);

            return datatables()->of($tiers)
            ->make(true);
    }

    public function odsTable(Request $request)
    {
        //dd($request->ref_sin);
            $ods = ods::where('ref_sinistre',$request->ref_sin)->where('etat','=','1')
            ->leftJoin('status_ods', 'ods.status', '=','status_ods.id')
            ->select('ods.id', 'num_ods', 'ref_sinistre', 'status', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'code_expert', 'status_ods.libelle');

            return datatables()->of($ods)->addColumn('detail', function ($data) {
                    return '<a href="#top" class="voir-detail btn btn-sm btn-primary" title="Voir détail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>';
            })->rawColumns(['detail'])
            ->make(true);
    }

    public function odsTableAll(Request $request)
    {
        //dd($request->ref_sin);
            $ods = ods::select('id', 'num_ods', 'ref_sinistre', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule')
                ->with('rdv')
                // ->where('ref_sinistre',$request->ref_sin)
                ;
            return datatables()->of($ods)
                    ->addColumn('detail', function ($data) {
                        return '<a href="#top" class="voir-detail btn btn-sm btn-primary" title="Voir détail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>';
                        })
                    ->rawColumns(['detail'])
                    ->make(true);
    }

    public function odsTablePriv(Request $request)
    {
        //dd($request->ref_sin);
            $ods = ods::where('ref_sinistre',$request->ref_sin)->where('etat','=','1')->leftJoin('status_ods', 'ods.status', '=','status_ods.id')->select('ods.id', 'num_ods', 'ref_sinistre', 'status', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'status_ods.libelle', 'code_expert');

            return datatables()->of($ods)->addColumn('Annuler', function ($data) {
                    return '<a href="#top" class="voir-detail btn btn-sm btn-secondary" title="Annuler" onclick="myFunctionAnnuler()"><i class="mdi mdi-stop-circle"></i> </a>';
            // })->addColumn('Supprimer', function ($data) {
            //         return '<a href="#top" class="supprimer-popoup btn btn-sm btn-danger" title="supprimer" onclick="myFunctionDelete()"><i class="mdi mdi mdi-delete"></i></a>';
            })->addColumn('detail', function ($data) {
                    return '<a href="#top" class="annuler-popup btn btn-sm btn-primary" title="Voir dÃ©tail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>';
            })->rawColumns(['detail','Annuler'])
            ->make(true);
    }

    public function store(Request $request)
    {

        $ods=ods::where('ref_sinistre',$request->ref_sinistre)->get();
        $nbr_ods=count($ods)+1;

        // $expert=experts_details::where('code',$request->expert)->first();
        $user=User::where('nom',$request->expert)->first();
        $detail = experts_details::find($user->id);

        $t=5;

        $when = Carbon::now()->addSeconds($t);

        //Notification::send($user, (new AddOds($ods->first()->id))->delay($when));

        $data = [
            'num_ods' => $nbr_ods,
            'ref_sinistre' => $request->ref_sinistre,
            'agence' => substr($request->ref_sinistre,0,5),
            'date_sinistre' => $request->date_sinistre,
            'ref_police' => $request->ref_police,
            'nom_tiers' => $request->tiers,
            'prenom_tiers' => $request->tiers,
            'date_ods' => $request->date_ods,
            'expert' => $user->nom.' '.$user->prenom,
            'matricule' => $request->matricule,
            'remarque' => $request->remarque,
            'marque' => $request->marque,
            'model' => $request->model,
            'num_serie' => $request->num_serie,
            'num_tel' => $request->num_tel,
            'status' => 1,
            'code_expert' => $detail->code,
        ];

        //if($this->validate($request, $rules)){
            ods::create($data);
            //Alert::message('L\'utilisateur a été ajouté');
            $message=MessageErreur::findOrFail(1);
            return redirect()->route('ods.creer')
                             ->withSuccess($message->libelle);

        // }
        // else{
        //     return redirect()->route('utilisateur.index')
        //                      ->withError("L'utilisateur n'a pas été ajouté, veuillez corriger les erreurs suivantes: ");
        // }
    }

    public function relance()
    {
        $this->breadcrumb_lis_append(['title' => 'Relance ODS' , 'url' => 'ods.relance', 'id' => '' ]);
        $breadcrumb_lis =  $this->breadcrumb_lis;

        return view('ODS.relance', compact('breadcrumb_lis'));
    }

    public function relanceTable(Request $request)
    {
        $ods = ods::leftJoin('status_ods', 'ods.status', '=','status_ods.id')->select('ods.id', 'num_ods', 'ref_sinistre', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'status','libelle');

            return datatables()->of($ods)->addColumn('relance', function ($data) {
                    return '<a href="#relance" class="relance btn btn-sm btn-primary" title="Relance" onclick="myFunction2()"><i class="mdi mdi-alarm"></i> </a>';
                    })->addColumn('detail', function ($data) {
                    return '<a href="#top" class="voir-detail btn btn-sm btn-primary" title="Voir détail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>';
            })->rawColumns(['relance','detail'])
            ->make(true);

    }

    public function relanceOdsTable(Request $request)
    {
         $relance = Relance::select('id','date_relance','remarque');
            return datatables()->of($relance)
            ->make(true);
    }

    public function relanceOds(Request $request)
    {
         $ods=ods::find($request->id);
         //dd($request->remarque_relance);

         $expert=experts_details::where('code',$ods->code_expert)->first();
         $user=User::where('id',$expert->id)->first();

         //$user = User::where('id', 1)->get();

         $t=5;

         $when = Carbon::now()->addSeconds($t);

         Notification::send($user, (new RelanceOds($ods->id))->delay($when));

         $data = [
            'id_ods' => $ods->id,
            'date_relance' => now(),
            'remarque' => $request->remarque_relance,
        ];
        relance::create($data);
        $message=MessageErreur::findOrFail(1);
        return Response()->json(['url'=> route('ods.relance'),
                                 'message'=> $message->libelle] ,200);
    }

    public function annuler_ods(Request $request)
    {
        $x=ods::where('id', $request->ods)->limit(1)->update(array('etat' => 0));
        $x=ods::where('id', $request->ods)->first();
        // dd($x);
        return redirect()->route('ods.annuler_supprimer')->withSuccess("L'Etat de l'ods numero ".$x->num_ods." relatif au dossier sinistre numero ".$x->ref_sinistre." a été changer de 'actif' Vers 'Annuler'.");
    }

    public function modifier_ods(Request $request)
    {

         $ods=ods::find($request->ods);

         $expert=experts_details::where('code',$ods->code_expert)->first();

         $user=User::where('id',$expert->id)->first();

         $t=5;

         $when = Carbon::now()->addSeconds($t);

         Notification::send($user, (new EditOds($ods->id))->delay($when));


        //date_ods
        //expert
        //remarque
        $x=ods::where('id', $request->ods)->limit(1)->update(array('date_ods' => $request->date_ods, 'expert' => $request->expert, 'remarque' => $request->remarque));
        $x=ods::where('id', $request->ods)->first();
        // dd($x);
        return redirect()->route('ods.modifier')->withSuccess("L'ODS Numero ".$x->num_ods." relatif au dossier sinistre numero ".$x->ref_sinistre." a été modifiée");
    }

    public function recupeInfo(Request $request)
    {

        $ods=ods::find($request->id);


        $ods=$ods->toArray();
        $message=MessageErreur::findOrFail(1);
        return Response()->json($ods ,200);
    }


}
