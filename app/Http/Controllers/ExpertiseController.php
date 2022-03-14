<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ods;
use App\Choc;
use App\Direction;
use App\Expertise;
use App\User;
use App\experts_details;
use App\FournituresChoc;
use App\AutreFournituresChoc;
use App\AutreExpertise;
use App\agence_user;
use App\Agence;
use App\Dossier;

use App\Typechoc;
use App\Status_expertise;
use App\Status_ods;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;

use App\AuditAction;
use App\Inscription;
use App\Honoraire;
use App\BaremeHonoraire;
use App\Console\Commands\DossierExlu;
use App\FraisHonoraire;

use PDF;
use App\Tiers;
use App\NumberFormatter;
use App\Ods_etat;
use App\NumExpertise;
use App\dossier_exlu;
use App\Photo;

use Notification;
use Carbon\Carbon;

use App\Notifications\AddExpertise;
use App\Notifications\ValidateExpertise;
use App\Notifications\DevalidateExpertise;
use App\Notifications\ValidateExpertiseExpert;

use App\Mail\SendMailExpertise;
use Illuminate\Support\Facades\Mail;

class ExpertiseController extends Controller
{
     public function __construct()
    {
         $this->middleware('auth');
         $this->breadcrumb_lis_append(['title' => 'Liste des ODS en instances' , 'url' => 'expertise.liste', 'id' => '' ]);
    }


    public function liste (){


        $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('expertise.liste', compact('breadcrumb_lis'));

    }

    public function listeTable(Request $request){

        $code_agence=Auth::user()->agences()->get();
        $code_agence=$code_agence->pluck('CODE')->toArray();
        $dossier_exlu=dossier_exlu::All()->pluck('id')->toArray();
        //dd($code_agence->toArray());
        if (Auth::user()->previllege==="expert"){
        $expert=experts_details::find(Auth::user()->id);
        $ods = ods::leftJoin('ods_etat','ods.id','=','ods_etat.id_ods')
        ->leftJoin('status_ods', 'ods_etat.id_status', '=','status_ods.id')
        ->select('ods.id', 'num_ods', 'ref_sinistre', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'status','libelle')
        ->where('code_expert',$expert->code)
        ->whereNotIn('ods.id', $dossier_exlu);
        }
        if (Auth::user()->previllege==="agence" || Auth::user()->previllege==="dr"){
        $ods = ods::leftJoin('ods_etat','ods.id','=','ods_etat.id_ods')
        ->leftJoin('status_ods', 'ods_etat.id_status', '=','status_ods.id')
        ->select('ods.id', 'num_ods', 'ref_sinistre', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'status','libelle')
        ->whereIn('agence',$code_agence)
        ->whereNotIn('ods.id', $dossier_exlu);
        }
        if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
        $ods = ods::leftJoin('ods_etat','ods.id','=','ods_etat.id_ods')
        ->leftJoin('status_ods', 'ods_etat.id_status', '=','status_ods.id')
        ->select('ods.id', 'num_ods', 'ref_sinistre', 'date_sinistre', 'ref_police', 'nom_tiers', 'prenom_tiers', 'date_ods', 'expert', 'matricule', 'remarque', 'marque', 'model', 'num_serie', 'num_tel', 'status','libelle')
        ->whereNotIn('ods.id', $dossier_exlu);
        }

            return datatables()->of($ods)->addColumn('detail', function ($data) {
                    return '<a href="#" class="voir-detail btn btn-sm btn-primary" title="Voir détail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>';
            })->rawColumns(['detail'])
            ->editColumn('libelle', function ($data){
                if(!$data->libelle)
                    return 'Nouveau';
                else return $data->libelle;
            })
            ->make(true);

    }

    public function traitementTable(Request $request){

        $expertise=Expertise::leftJoin('ods', 'expertise.id_ods', '=','ods.id')
                            ->leftJoin('status_expertise', 'expertise.status', '=','status_expertise.id')
                            ->leftJoin('type_expertise', 'expertise.type', '=','type_expertise.id')
                            ->select('expertise.id', 'id_ods','status_expertise.libelle as libelle', 'MTC_expertise', 'expert',
                                'type_expertise.libelle as type','expertise.num_expertise', 'expertise.created_at')
                            ->where('id_ods',$request->id_ods);


            return datatables()->of($expertise)->addColumn('detail', function ($data) {
                    return '<a href="#recap_pv" class="voir-detail btn btn-sm btn-primary" title="Récap" onclick="myFunction()"><i class="ion ion-eye"></i> </a>';
            })->rawColumns(['detail'])
            ->make(true);

    }

    public function show(Expertise $expertise ){

        $expertise = $expertise;

        return $this->creer(Request() ,$expertise->id_ods, $expertise->id);

    }

    public function new(Request $request){

        $ods=ods::find($request->id);
        $status_ods=Status_ods::where('id',$ods->status)->first();
        $expertise=Expertise::where('id_ods',$ods->id)->first();
        if (!$expertise){
            $expertise = Expertise::create(
                ['id_ods'=> $ods->id,
                'model'=> $request->model
            ]
        );
            if($request->model != 1 || $request->model != 5){
            AutreExpertise::create(['expertise_id'=>$expertise->id]);
            }
            $etat=ods_etat::where('id_ods',$ods->id);
            $etat->create(
                ['id_ods' => $ods->id,
                 'id_status' => 2]
            );

            $t=5;

            $when = Carbon::now()->addSeconds($t);

            $users = User::whereIn('previllege',['admin','backoffice','supbackoffice'])->get();

            $expert= experts_details::where('code',$ods->code_expert)->first();
            $user =User::find($expert->id);
            $users->push($user);

            //Notification::send($users, (new AddExpertise($expertise->id))->delay($when));
            //Notification::send($users, (new AddExpertise($expertise->id)));

            //$this->mail($expertise->id,'créée');
            $this->mail2($expertise->id,'créée');

        }

        return $this->creer(Request(),$ods->id, $expertise->id);

    }

    public function store(Request $request){

        $ods=ods::find($request->id_ods);

        $expertise=Expertise::find($request->expertise_id);

        $expertise->update(
            [
                'date_expertise'=>$request->date_expertise,
                'heure_expertise'=>$request->heure_expertise,
                'lieu_expertise'=>$request->lieu_expertise,
                'couleur'=>$request->couleur,
                'valeur_venal'=>$request->valeur_venal,
                'taux_resp'=>$request->taux_resp,
                'observation'=>$request->observation,
            ]);

        return $this->creer(Request(),$ods->id, $request->expertise_id);

    }

    public function storeother(Request $request){

        $valeur_venal=$request->valeur_venal;

        $ods=ods::find($request->id_ods);

        $expertise_autre=AutreExpertise::where('expertise_id',$request->expertise_id)->first();



        $expertise_autre->update(
            [
                'valeur'=>$request->valeur,
                'service_epave'=>$request->epave,
                'prejudice'=>$request->prejudice,
                'description'=>$request->description,
                'taux_reforme' => $request->taux_reforme,
                //'observation'=>$request->observation,
            ]);

        $expertise=Expertise::find($request->expertise_id);

        if($expertise->model == 2)
            $valeur_venal=$request->valeur;

        $expertise->update(
            [
                'date_expertise'=>$request->date_expertise,
                'heure_expertise'=>$request->heure_expertise,
                'lieu_expertise'=>$request->lieu_expertise,
                'MTC_expertise'=>$request->prejudice,
                'couleur'=>$request->couleur,
                'valeur_venal'=>$valeur_venal,
                'taux_resp'=>$request->taux_resp,
                'observation'=>$request->observation,
            ]);

        return $this->creer(Request(),$ods->id, $request->expertise_id);

    }

    public function creer(Request $request , $idOds=0 , $idExpertise=0){

    	$ods=ods::find($idOds !=0 ? $idOds :  $request->id );


        $status_ods=Status_ods::where('id',$ods->status)->first();

        if(!$idExpertise){
            $expertise=Expertise::where('id_ods',$ods->id)
            ->where('type',1)
            ->first();
        }else{
            $expertise=Expertise::find($idExpertise);
        }




    	if (!$expertise){

            if (Auth::user()->previllege==="agence"){
                Alert::warning('Avertissement', 'Vous n\'avez pas l\'autorisation d\'accéder');
                return back();
            }

            $breadcrumb_lis =  $this->breadcrumb_lis ;

            return view('expertise.choix_model',compact('ods','breadcrumb_lis'));

    	}

        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $expertise->id ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();

        $somme=0;
        foreach ($honoraires as $honoraire) {
            $somme=$somme+$honoraire->montant;
        }

        if ($expertise->model == 1){
        $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
        $choc_listes=Typechoc::select('choc')
                            ->whereNotIn('choc',$typeUsed)
                            ->get();

    		return view('expertise.ajout',compact('ods', 'expertise','choc_listes','status_ods','breadcrumb_lis','honoraires','somme'));

        }elseif($expertise->model == 2){
            //$typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
            //$choc_listes=Typechoc::select('choc')
                            // ->whereNotIn('choc',$typeUsed)
                            // ->get();
            $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
            //dd($AutreExpertise);
            return view('expertise.ajout_reforme',compact('ods', 'expertise','status_ods','AutreExpertise','breadcrumb_lis','honoraires','somme'));

        }elseif($expertise->model == 3){
        // $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
        // $choc_listes=Typechoc::select('choc')
        //                     ->whereNotIn('choc',$typeUsed)
        //                     ->get();
            $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
            //dd($AutreExpertise);
            return view('expertise.ajout_vol',compact('ods', 'expertise','status_ods','AutreExpertise','breadcrumb_lis','honoraires','somme'));
        }elseif($expertise->model == 4){
        // $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
        // $choc_listes=Typechoc::select('choc')
        //                     ->whereNotIn('choc',$typeUsed)
        //                     ->get();
            $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
            //dd($AutreExpertise);
            return view('expertise.ajout_incendie',compact('ods', 'expertise','status_ods','AutreExpertise','breadcrumb_lis','honoraires','somme'));
        }elseif($expertise->model == 5){
        // $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
        // $choc_listes=Typechoc::select('choc')
        //                     ->whereNotIn('choc',$typeUsed)
        //                     ->get();
            //$AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
            //dd($AutreExpertise);
            return view('expertise.ajout_ras',compact('ods', 'expertise','status_ods','breadcrumb_lis','honoraires','somme'));
        }
        elseif($expertise->model == 6){
        // $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
        // $choc_listes=Typechoc::select('choc')
        //                     ->whereNotIn('choc',$typeUsed)
        //                     ->get();
            $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
            //dd($AutreExpertise);
            return view('expertise.ajout_carence',compact('ods', 'expertise','status_ods','breadcrumb_lis','AutreExpertise','honoraires','somme'));
        }

    }

    public function contre(Request $request){

        $ods=ods::find($request->id);

        $status_ods=Status_ods::where('id',$ods->status)->first();

        $expertise=Expertise::where('id_ods',$ods->id)->first();

        if($expertise->model == 2 || $expertise->model == 3 || $expertise->model == 4 || $expertise->model == 5 || $expertise->model == 6){
            Alert::warning('Avertissement', 'Un additif ne peut pas etre ajouté a ce type de PV');
            return back();
        }
        if($expertise->status == 1){
            Alert::warning('Avertissement', 'Une expertise en cours de validation existe!');
            return back();
        }

        $id_parent=$expertise->id;
        $contre=Expertise::where('id_parent',$expertise->id);
        $contre_vérif=Expertise::where('id_parent',$expertise->id)
                                  ->where('status',1)
                                  ->count();
        if($contre_vérif){
            Alert::warning('Avertissement', 'Une contre expertise en cours de validation existe!');
            return back();
        }else{
        $nbr_contre=$contre->count();
        $nbr_contre=$nbr_contre+1;
        if ($expertise->type==1){
            $expertise = Expertise::create([
                'id_ods'=> $ods->id,
                'type'=> 3,
                'id_parent'=> $id_parent,
                'num_expertise'=>  $nbr_contre,
                'model'=> 1
            ]);
        }
        $etat=ods_etat::where('id_ods',$ods->id);
            $etat->update(
                ['id_status' => 6]
            );

        $expertise=Expertise::find($expertise->id);

        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $expertise->id ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();

        $somme=0;
        foreach ($honoraires as $honoraire) {
            $somme=$somme+$honoraire->montant;
        }

        if ($expertise->model == 1){
        $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc');
        $choc_listes=Typechoc::select('choc')
                            ->whereNotIn('choc',$typeUsed)
                            ->get();

            return view('expertise.ajout',compact('ods', 'expertise','choc_listes','status_ods','breadcrumb_lis','honoraires','somme'));

        }

        }

    }

    public function modifierContre(Request $request){

        $expertise=Expertise::find($request->id);
        $ods=ods::find($expertise->id_ods);
        return $this->creer(Request(),$ods->id, $expertise->id);

    }

    public function creerAdditif(Request $request){

        $ods=ods::find($request->id);

        $status_ods=Status_ods::where('id',$ods->status)->first();

        $expertise=Expertise::where('id_ods',$ods->id)->first();

        if($expertise->model == 2 || $expertise->model == 3 || $expertise->model == 4 || $expertise->model == 5 || $expertise->model == 6){
            Alert::warning('Avertissement', 'Un additif ne peut pas etre ajouté a ce type de PV');
            return back();
        }
        if($expertise->status == 1){
            Alert::warning('Avertissement', 'Une expertise en cours de validation existe!');
            return back();
        }

        if (Auth::user()->previllege==="agence"){
                Alert::warning('Avertissement', 'Vous n\'avez pas l\'autorisation d\'accéder');
                return back();
            }

        $verif_contre_expertise = Expertise::where('id_ods',$ods->id)
                                  ->where('type',3)
                                  ->first();

        if($verif_contre_expertise){
            Alert::warning('Avertissement', 'Une contre expertise existe!');
            return back();
        }


        $id_parent=$expertise->id;
        $additif=Expertise::where('id_parent',$expertise->id);
        $additif_vérif=Expertise::where('id_parent',$expertise->id)
                                  ->where('status',1)
                                  ->count();
        if($additif_vérif){
            Alert::warning('Avertissement', 'Un additif en cours de validation existe!');
            return back();
        }else{
        $nbr_additif=$additif->count();
        $nbr_additif=$nbr_additif+1;
        if ($expertise->type==1){
            $expertise = Expertise::create([
                'id_ods'=> $ods->id,
                'type'=> 2,
                'id_parent'=> $id_parent,
                'num_expertise'=>  $nbr_additif,
                'model'=> 1
            ]);
        }
        $etat=ods_etat::where('id_ods',$ods->id);
            $etat->update(
                ['id_status' => 4]
            );

        $expertise=Expertise::find($expertise->id);

        $t=5;

        $when = Carbon::now()->addSeconds($t);

        $users = User::whereIn('previllege',['admin','backoffice','supbackoffice'])->get();

        $expert= experts_details::where('code',$ods->code_expert)->first();
        $user =User::find($expert->id);
        $users->push($user);

        //Notification::send($users, (new AddExpertise($expertise->id))->delay($when));
        //Notification::send($users, (new AddExpertise($expertise->id)));

        //$this->mail($expertise->id,'créée');
        $this->mail2($expertise->id,'créée');

        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $expertise->id ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();

        $somme=0;
        foreach ($honoraires as $honoraire) {
            $somme=$somme+$honoraire->montant;
        }

        $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id_parent)->get()->pluck('choc');
        $choc_listes=Typechoc::select('choc')
                            ->whereIn('choc',$typeUsed)
                            ->get();

            return view('expertise.ajout',compact('ods', 'expertise','choc_listes','status_ods','breadcrumb_lis','honoraires','somme'));
        }

    }

    public function modifierAdditif(Request $request){

        $expertise=Expertise::find($request->id);
        $ods=ods::find($expertise->id_ods);

        $status_ods=Status_ods::where('id',$ods->status)->first();

        // $ods=ods::leftJoin('status_ods', 'ods.status', '=','status_ods.id')
        //           ->where('ods.id', $request->id)
        //           ->first();

        $typeUsedParnent = Choc::select('choc')->where('chocs.expertise_id',$expertise->id_parent)->get();//->pluck('choc');

        $typeUsed = Choc::select('choc')->where('chocs.expertise_id',$expertise->id)->get()->pluck('choc')->toArray();

        $typeReste = $typeUsedParnent->reject(function ($val) use($typeUsed) {
            return in_array($val->choc, $typeUsed);
        });
        $etat=ods_etat::where('id_ods',$ods->id);
            $etat->update(
                ['id_status' => 3]
            );

        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $expertise->id ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();

        $somme=0;
        foreach ($honoraires as $honoraire) {
            $somme=$somme+$honoraire->montant;
        }


        $choc_listes=Typechoc::select('choc')
                               ->whereIn('choc',$typeReste->pluck('choc'))
                               ->get();

            return view('expertise.ajout',compact('ods', 'expertise','choc_listes','status_ods','breadcrumb_lis','honoraires','somme'));

    }

    public function chocTable(Request $request){

        $choc = Choc::select('id', 'expertise_id', 'choc', 'description', 'main_oeuvre', 'immobilisation', 'remarque', 'etat','MTC_choc', 'valide_at')
             ->where('expertise_id',$request->id_expertise)
        ;

        $expertise=Expertise::find($request->id_expertise);

        if ($expertise->status == 1){
            return datatables()->of($choc)->addColumn('detail', function ($data) {
                    return '<a href="'.route('choc.show',$data->id).'" class="voir-detail btn btn-sm btn-primary" title="Voir détail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>'. '<a href="'.route('choc.edit',$data->id).'" class="voir-detail btn btn-sm btn-primary ml-2" title="Modifier" onclick="myFunction()"><i class="mdi mdi-domain"></i> </a>';
            })->rawColumns(['detail'])
            ->make(true);
        }else{
            return datatables()->of($choc)->addColumn('detail', function ($data) {
                    return '<a href="'.route('choc.show',$data->id).'" class="voir-detail btn btn-sm btn-primary" title="Voir détail" onclick="myFunction()"><i class="mdi mdi-information-variant"></i> </a>';
            })->rawColumns(['detail'])
            ->make(true);
        }

    }

    public function fournitureTable(Request $request){

        $autre_fourniture = AutreFournituresChoc::select('id', 'libelle as intitule', 'libelle', 'nb', 'price', 'total', 'statut')
        ->where('choc_id',$request->id_choc)
        ;
        $fourniture = FournituresChoc::leftJoin('pieces', 'fournitures_chocs.piece_id', '=','pieces.id')
        ->leftJoin('categoriespieces','pieces.cat_pieces','categoriespieces.id')
        ->select('fournitures_chocs.id', 'intitule', 'categoriespieces.libelle', 'nb', 'price', 'total', 'statut')
                      ->where('choc_id',$request->id_choc)
                       ->union($autre_fourniture)
        ;


        //dd($fourniture->toSql());

            return datatables()->of($fourniture)
            ->make(true);

    }
    public function valider(Request $request,Expertise $expertise){



        $ods=ods::find($expertise->id_ods);

        // $verif_num_pv=NumExpertise::where('num_pv',$request->num_pv)
        //                           ->where('code_expert',$ods->code_expert)
        //                           ->where('code_agence',$ods->agence)
        //                           ->get()->toArray();

        // if($verif_num_pv){
        //          Alert::warning('Avertissement', 'Vous avez affecté le meme numéro de pv pour cette agence');
        //         return $this->creer(Request(),$expertise->id_ods,$expertise->id);
        //     }

        $honoraire=Honoraire::where('expertise_id',$expertise->id)->get()->toArray();
            if(!$honoraire){
                 Alert::warning('Avertissement', 'Merci de saisir les frais d\'honoraire');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);
            }
        // if (!$request->num_pv){
        //     Alert::warning('Avertissement', 'Merci de saisir un numero de pv');
        //         return $this->creer(Request(),$expertise->id_ods,$expertise->id);
        // }
        $expertise =$expertise;

        /////////////////////////////////////////////////////// vérification de photos ////////////////////////////////////////////////////////////
        if($expertise->model != 3){
            $photos=Photo::where('expertise_id',$expertise->id)->get()->toArray();
            if(!$photos){
                Alert::warning('Avertissement', 'Merci d\'inserer les photos');
               return $this->creer(Request(),$expertise->id_ods,$expertise->id);
           }

           $nbr_min=Inscription::find(2)->nbr;
           $nbr_max=Inscription::find(3)->nbr;

           if(count($photos) < $nbr_min){
            Alert::warning('Avertissement', 'Le nombre minimum de photos est de '.$nbr_min);
            return $this->creer(Request(),$expertise->id_ods,$expertise->id);
           }
           if(count($photos) > $nbr_max){
            Alert::warning('Avertissement', 'Le nombre maximum de photos est de '.$nbr_max);
            return $this->creer(Request(),$expertise->id_ods,$expertise->id);
           }
        }

        if($expertise->model == 1 ){
            if(!$expertise->date_expertise || !$expertise->heure_expertise || !$expertise->lieu_expertise || !$expertise->couleur || !$expertise->valeur_venal){
                Alert::warning('Avertissement', 'Vous devez remplir les champs (Date, Heure, Lieu, Couleur et Valeur Vénal) et sauvegarder avant de valider');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);
            }
            $choc=Choc::where('expertise_id',$expertise->id)->get()->toArray();
            if(!$choc){
                Alert::warning('Avertissement', 'Merci de creer au moins un choc avant la validation!');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);
            }
                $baremes = BaremeHonoraire::all();
                foreach ($baremes as $bareme ) {
                    if($expertise->MTC_expertise >= $bareme->montant_a && $expertise->MTC_expertise <= $bareme->montant_b){
                        if ($bareme->id == 1 ){
                            $honoraire = $bareme->maximum;
                        }else{
                        $honoraire=($expertise->MTC_expertise-$bareme->montant_a+1);
                        $honoraire=$honoraire*$bareme->sur_b/100;
                        $honoraire=$honoraire+$bareme->minimum;
                        }
                        $honoraire=number_format($honoraire,2,'.', '');
                    }
                }
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'honoraire',
                    'nombre'=>1,
                    'montant'=>$honoraire
                ]);
                $user_expert=experts_details::where('code',$ods->code_expert)->first();
                if ($user_expert->tva == 1){
                $tva_honoraire = $honoraire*0.19;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'TVA',
                    'nombre'=>1,
                    'montant'=>$tva_honoraire
                ]);
                }
        }
        elseif($expertise->model == 2 || $expertise->model == 3 || $expertise->model == 4){
            $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
            if(!$AutreExpertise->valeur || !$AutreExpertise->prejudice || !$expertise->date_expertise || !$expertise->heure_expertise || !$expertise->lieu_expertise || !$expertise->couleur || !$expertise->valeur_venal){
                Alert::warning('Avertissement', 'Vous devez remplir les champs (Date, Heure, Lieu, Couleur, Valeur Vénal et les montants) et sauvegarder avant de valider');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);
            }
            if($expertise->model == 2){
                $honoraire = 3000;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'honoraire',
                    'nombre'=>1,
                    'montant'=>$honoraire
                ]);
                $user_expert=experts_details::where('code',$ods->code_expert)->first();
                if ($user_expert->tva == 1){
                $tva_honoraire = $honoraire*0.19;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'TVA',
                    'nombre'=>1,
                    'montant'=>$tva_honoraire
                ]);
                }
                $AutreExpertise->update(['epave'=>'oui']);
            }elseif($expertise->model == 3){
                $honoraire = 1000;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'honoraire',
                    'nombre'=>1,
                    'montant'=>$honoraire
                ]);
                $user_expert=experts_details::where('code',$ods->code_expert)->first();
                if ($user_expert->tva == 1){
                $tva_honoraire = $honoraire*0.19;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'TVA',
                    'nombre'=>1,
                    'montant'=>$tva_honoraire
                ]);
                }
                $AutreExpertise->update(['epave'=>'non']);
            }elseif($expertise->model == 4){
                if($AutreExpertise->service_epave > 0 ){
                 $honoraire = 3000;
                 $AutreExpertise->update(['epave'=>'oui']);
                }else {
                 $honoraire = 1000;
                 $AutreExpertise->update(['epave'=>'non']);
                }

                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'honoraire',
                    'nombre'=>1,
                    'montant'=>$honoraire
                ]);
                $user_expert=experts_details::where('code',$ods->code_expert)->first();
                if ($user_expert->tva == 1){
                $tva_honoraire = $honoraire*0.19;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'TVA',
                    'nombre'=>1,
                    'montant'=>$tva_honoraire
                ]);
                }


            }

        }elseif($expertise->model == 5 || $expertise->model == 6){
        if($expertise->model == 5){
                $honoraire = 1000;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'honoraire',
                    'nombre'=>1,
                    'montant'=>$honoraire
                ]);
                $user_expert=experts_details::where('code',$ods->code_expert)->first();
                if ($user_expert->tva == 1){
                $tva_honoraire = $honoraire*0.19;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'TVA',
                    'nombre'=>1,
                    'montant'=>$tva_honoraire
                ]);
                }
                //$AutreExpertise->update(['epave'=>'non']);
            }elseif($expertise->model == 6){
                $honoraire = 1000;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'honoraire',
                    'nombre'=>1,
                    'montant'=>$honoraire
                ]);
                $user_expert=experts_details::where('code',$ods->code_expert)->first();
                if ($user_expert->tva == 1){
                $tva_honoraire = $honoraire*0.19;
                Honoraire::create([
                    'expertise_id'=>$expertise->id,
                    'libelle'=>'TVA',
                    'nombre'=>1,
                    'montant'=>$tva_honoraire
                ]);
                }
                //$AutreExpertise->update(['epave'=>'non']);
            }
        }

        $audit = new AuditAction();
        $audit->audit(auth()->user()->username,'validation','validation pv id: '.$expertise->id);

        $expertise->update(['status'=>2]);


        $inscri=Inscription::where('id',1)->first();
        $numero_police=$inscri->nbr + 1;

        Inscription::where('id',1)->update(['nbr' => $numero_police]);


        NumExpertise::create([
            'id_expertise' => $expertise->id,
            'num_pv' => $numero_police,
            'code_expert' => $ods->code_expert,
            'code_agence' => $ods->agence,
        ]);
        $etat=ods_etat::where('id_ods',$ods->id);
            $etat->update(
                ['id_status' => 3]
            );

            $t=5;

            $when = Carbon::now()->addSeconds($t);

            $users = User::whereIn('previllege',['admin','backoffice','supbackoffice'])->get();

            $expert= experts_details::where('code',$ods->code_expert)->first();
            $user =User::find($expert->id);
            $users->push($user);

            //Notification::send($users, (new ValidateExpertiseExpert($expertise->id))->delay($when));
            //Notification::send($users, (new ValidateExpertiseExpert($expertise->id)));

            //$this->mail($expertise->id,'validée');
            $this->mail2($expertise->id,'validée');

        return redirect()->route('expertise.show',$expertise->id)
                                     ->withSuccess("l'expertise a été Validée");

    }

    public function devalider(Request $request, Expertise $expertise){
        $expertise =$expertise;
        if ($expertise->status == 3){
                Alert::warning('Avertissement', 'impossible de dévalider une expertise déja valider');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);

        }
        if ($expertise->type == 1){
            $additif=Expertise::where('id_parent',$expertise->id)->get()->toArray();
            if($additif){
                Alert::warning('Avertissement', 'impossible de dévalider car un additif existe ! merci de supprimer l\'additif');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);
            }
        }

        if(!$request->motif_rejet){
                Alert::warning('Avertissement', 'Merci d\'insérer le motif de rejet');
                return $this->creer(Request(),$expertise->id_ods,$expertise->id);
            }

        $audit = new AuditAction();
        $audit->audit(auth()->user()->username,'devalidation','Dévalidation pv id: '.$expertise->id);



        $expertise->update([
            'status'=>1,
            'motif_rejet'=>$request->motif_rejet,
        ]);
        $ods=ods::find($expertise->id_ods);
        $etat=ods_etat::where('id_ods',$ods->id);
            $etat->update(
                ['id_status' => 2]
            );
        $honoraire=Honoraire::where('expertise_id',$expertise->id)
                            ->whereIn('libelle',['honoraire','TVA']);
        $honoraire->delete();

        $num_expertise=NumExpertise::where('id_expertise',$expertise->id);
        $num_expertise->delete();

        $t=5;

        $when = Carbon::now()->addSeconds($t);

        $users = User::whereIn('previllege',['admin','backoffice','supbackoffice'])->get();

        $expert= experts_details::where('code',$ods->code_expert)->first();
        $user =User::find($expert->id);
        $users->push($user);

        //Notification::send($users, (new DevalidateExpertise($expertise->id))->delay($when));
        //Notification::send($users, (new DevalidateExpertise($expertise->id)));

        return redirect()->route('expertise.show',$expertise->id)
                                     ->withSuccess("l'expertise a été Dévalidée");

    }

    public function imprimmer(Expertise $expertise){
        //recuperation de l'ODS
        $ods=ods::where('id',$expertise->id_ods)->first();

        //recuperation de l'Expertise
        $expertise =$expertise;

        // Recuperation de l'Expert
        $expert=experts_details::where('code',$ods->code_expert)->leftJoin('users','experts_details.id','=','users.id')->first();
        $chocs=Choc::where('expertise_id',$expertise->id)->get();

        //recuperation de la liste des chocs

        //recuperation de la liste des fournitures
        return view('expertise.imprimer_reforme', compact('expert','expertise','ods','chocs'));
    }

    public function destroy(Expertise $expertise){

        //recuperation de l'Expertise
        $expertise =$expertise;

        if ($expertise->status == 2){

            Alert::warning('Avertissement', 'Impossible de supprimer l\'expertise car ce dernier est validé');

            return $this->creer(Request(),$expertise->id_ods,$expertise->id);

        }

        $audit = new AuditAction();

        $audit->audit(auth()->user()->username,'Suppression','Suppression pv id: '.$expertise->id);

        $etat=ods_etat::where('id_ods',$expertise->id_ods);

        $etat->delete();

        $expertise->delete();

        return redirect()->route('expertise.liste')
                                     ->withSuccess("l'expertise a été Supprimée");

    }


public function validerfinalise(Expertise $expertise){

    $expertise =$expertise;

    $this->send_to_api($expertise);

    $audit = new AuditAction();
    $audit->audit(auth()->user()->username,'validation final','validation pv id: '.$expertise->id);

    $inscri=Inscription::where('id',19)->first();
    $numero_police=$inscri->nbr + 1;
    $code_validation="EXP119520".sprintf("%06d", $numero_police);

    $expertise->update([
        'status'=>3,
        'code'=>$code_validation
    ]);
    $ods=ods::find($expertise->id_ods);
    $etat=ods_etat::where('id_ods',$ods->id);
            $etat->update(
                ['id_status' => 5]
            );

    Inscription::where('id',19)->update(['nbr' => $numero_police]);

    $t=5;

    $when = Carbon::now()->addSeconds($t);

    $users = User::whereIn('previllege',['admin','backoffice','supbackoffice'])->get();

    $expert= experts_details::where('code',$ods->code_expert)->first();
    $user =User::find($expert->id);
    $users->push($user);

    //Notification::send($users, (new ValidateExpertise($expertise->id))->delay($when));
    //Notification::send($users, (new ValidateExpertise($expertise->id)));

    //$this->mail($expertise->id,'finalisée');

    //$this->mail2($expertise->id,'finalisée');

    return redirect()->route('expertise.show',$expertise->id)
    ->withSuccess("l'expertise a été Validée");

    }

    public function honoraire(Expertise $expertise){
        $expertise = $expertise;

        $ods=ods::find($expertise->id_ods);

        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $expertise->id ]);
        $breadcrumb_lis =  $this->breadcrumb_lis ;
        $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();
        $somme=0;
        foreach ($honoraires as $honoraire) {
            $somme=$somme+$honoraire->montant;
        }
        $frais= FraisHonoraire::all();
        return view('expertise.honoraire',compact('ods', 'expertise','breadcrumb_lis','honoraires','frais','somme'));

    }

    public function storeHonoraire(Request $request){
        //dd($request);
        $frais=FraisHonoraire::find($request->frais);
        $montant=0;
        $nombre=$request->nombre;
        if ($frais->id == 1){
            $h=Honoraire::where('expertise_id',$request->id)
            ->where('libelle','Déplacement véhicule personnel >= 40 km')->get()->toArray();
            if($h){
                Alert::warning('Avertissement', 'Déplacement véhicule personnel >= 40 km existe déja');
                return back();
            }

            $montant=$frais->montant;
            $nombre=1;
        }elseif ($frais->id == 4){
            $montant=$frais->montant;
            $nombre=1;
        }else{
            $montant=$frais->montant*$nombre;
        }



        $honoraire=Honoraire::where('expertise_id',$request->id)
                              ->where('libelle',$frais->libelle)->get()->toArray();
                              //dd($honoraire);
        if($honoraire){
        Alert::warning('Avertissement', 'existe déja');
            return back();
        }

        if($frais->id == 2){
            if($nombre < 40){
                Alert::warning('Avertissement', 'le Nombre de kilomètres doit être >= 40 Km');
                return back();
            }
            $h=Honoraire::where('expertise_id',$request->id)
            ->where('libelle','Déplacement véhicule personnel - 40 km')->get()->toArray();
            if($h){
                Alert::warning('Avertissement', 'Déplacement véhicule personnel - 40 km existe déja');
                return back();
            }
        }

        Honoraire::create([
                    'expertise_id'=>$request->id,
                    'libelle'=>$frais->libelle,
                    'nombre'=>$nombre,
                    'montant'=>$montant
                ]);

        return redirect()->route('expertise.honoraire',$request->id)
         ->withSuccess("Frais Ajouté");

    }

    public function destroyHonoraire(Honoraire $honoraire){

        $honoraire = $honoraire;

        $honoraire->delete();

        return redirect()->route('expertise.honoraire',$honoraire->expertise_id)
         ->withSuccess("Frais Supprimé");

    }

    public function imprimer_honoraire(Expertise $expertise){

        $expertise= $expertise;

        $status_expertise=Status_expertise::where('id',$expertise->status)->first();
        $ods=ods::where('id',$expertise->id_ods)->first();
        $choc_list=Choc::where('expertise_id',$expertise->id)->orderBy('choc')->get();
        $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
        $expert=experts_details::where('code',$ods->code_expert)->first();

        $plucked = $choc_list->pluck('id');

        $fourniture_list=FournituresChoc::whereIn('choc_id',$plucked)->get();
        $user=User::where('id',$expert->id)->first();
        $tiers=tiers::where('ref_sinistre',$ods->ref_sinistre)->where('tiers',1)->first();


        $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();
        $somme=0;
        foreach ($honoraires as $honoraire) {
            $somme=$somme+$honoraire->montant;
        }

        //if($expertise->model==1){
            $pdf = PDF::loadView('pdf_honoraire', compact('expertise','status_expertise','ods','choc_list','fourniture_list','expert','user','tiers','AutreExpertise','honoraires','somme'));
        //}
        return $pdf->stream();
        // return view('pdf_honoraire', compact('expertise','status_expertise','ods','choc_list','fourniture_list','expert','user','tiers','AutreExpertise','honoraires','somme'));

    }

    public function djilali(){

      $expertise=Expertise::find(2);
      $ods=Ods::find($expertise->id_ods);

		$mail= new SendMailExpertise();

        $user=User::find(1);

		$mail->data=$expertise;
      $mail->action='test';

       Mail::to($user)
      ->bcc('it-dev@allianceassirances.com.dz')
      ->send($mail);

	}

    public function mail($id,$action)
    {
      $expertise=Expertise::find($id);
      $ods=Ods::find($expertise->id_ods);
      $expert=experts_details::where('code',$ods->code_expert)->first();


      $mail= new SendMailExpertise();

      $user=User::find($expert->id);

      $agences = Agence::where('CODE',$ods->agence)->first();
      $agence_user = agence_user::where('agence_id',$agences->id)->get(array('user_id'));


      $user2=User::whereIn('previllege', ['backoffice','supbackoffice'])
                   ->orWhereIn('id',$agence_user)
                    ->get();



      //dd($user2);

      $mail->data=$expertise;
      $mail->action=$action;

      Mail::to($user)
      ->cc($user2)
      ->bcc('it-dev@allianceassirances.com.dz')
      ->send($mail);

    }

    public function mail2($id,$action)
    {


     $expertise=Expertise::find($id);
     $ods=Ods::find($expertise->id_ods);
     $expert=experts_details::where('code',$ods->code_expert)->first();


     $mail= new SendMailExpertise();

     $user=User::find($expert->id);

     $agences = Agence::where('CODE',$ods->agence)->first();
     $agence_user = agence_user::where('agence_id',$agences->id)->get(array('user_id'));


     $user2=User::whereIn('previllege', ['backoffice','supbackoffice'])
     ->orWhereIn('id',$agence_user)
     ->WhereNotIn('email',['smahdadi@allianceassurances.com.dz','lziaina@allianceassurances.com.dz','ssadaoui@allianceassurances.com.dz','cmatrah@allianceassurances.com.dz'])
     ->get();

     $to = $user->email;

     $subject = "E-Expertise";


     $listemail=implode(",", $user2->pluck('email')->toArray());

     $url=route('expertise.show',$expertise->id);


     $txt = "Une expertise a été ".$action." sous le N° ".$expertise->id;

     $txt=$txt." \r\n

     Voir détail  : ".$url." \r\n

     ";

     $headers = "From: expertise" . "\r\n" .
     "CC:".$listemail. "\r\n" .
     "BCC:"."it-dev@allianceassurances.com.dz"
     ;

     mail($to,$subject,$txt,$headers);

 }

 public function reporthonoraireods (){




    $expertid=Auth::user()->id;
    $expertprevillege=Auth::user()->previllege;

    $directions_list = Direction::all();

return view('report.reportods', compact('expertid','expertprevillege','directions_list', $directions_list));




}
function fetch(Request $request)
{
if(auth::user()->previllege==="agence"){
   $select = $request->post('select');
   $value = $request->post('value');
   $dependent = $request->post('dependent');
   if($dependent != "agence"){

    $d=auth::user()->id;

   $data=agence_user::where('user_id', $d) ->get();

       $output = '<option value="">Select '.ucfirst($dependent).'</option>';
       foreach($data as $rowusr)
       {
           $idagence=$rowusr->agence_id;
           $dataagence=agence::where('id', $idagence)->get();
            foreach($dataagence as $rowagence)
            {
$codeagence=$rowagence->CODE;
$dataods=ods::select('code_expert','expert')
->where('agence', $codeagence)
//->
//->groupby('agence')
->distinct('code_expert')

->get();

foreach($dataods as $row)
{

$output .= '<option value="'.$row->code_expert.'"> Expert '.$row->expert.'</option>';

}


            }

     }
       echo $output;

   }else{

      $data = Agence::where('DR', $value)
      ->distinct('CODE')
        ->get('CODE');

     // ->get();
      $output = '<option value="">Select '.ucfirst($dependent).'</option>';
      foreach($data as $row)
      {
       $output .= '<option value="'.$row->CODE.'"> agence'.$row->CODE.'</option>';
      }

      echo $output;
   }

}
elseif(auth::user()->previllege==="expert"){
   $expertid=Auth::user()->id;
   $experts_details = experts_details::where('id',$expertid)->first();
  $code= $experts_details->code;
   $select = $request->post('select');
   $value = $request->post('value');
   $dependent = $request->post('dependent');
   if($dependent != "agence"){

    $data = ods::select('code_expert','expert')
     ->where('agence', $value)
    ->where('code_expert',$code)
   -> distinct('code_expert')
     ->get();

       $output = '<option value="">Select '.ucfirst($dependent).'</option>';
      // foreach($data as $row)
     //  {
       $output .= '<option value="'.$code.'"> Expert '.$code.'</option>';
      //}
       echo $output;

   }else{
      $data = Agence::where('DR', $value)
      ->get();
      $output = '<option value="">Select '.ucfirst($dependent).'</option>';
      foreach($data as $row)
      {
       $output .= '<option value="'.$row->CODE.'"> agence'.$row->CODE.'</option>';
      }

      echo $output;
   }

}else{
   $select = $request->post('select');
   $value = $request->post('value');
   $dependent = $request->post('dependent');
   if($dependent != "agence"){

    $data = ods::select('code_expert','expert')
    ->where('agence', $value)
     ->distinct('code_expert')
       ->get();

       $output = '<option value="">Select '.ucfirst($dependent).'</option>';
       foreach($data as $row)
       {
       $output .= '<option value="'.$row->code_expert.'"> Expert '.$row->expert.'</option>';
      }
       echo $output;

   }else{
      $data = Agence::where('DR', $value)
      ->distinct('CODE')
       ->get('CODE');;
      $output = '<option value="">Select '.ucfirst($dependent).'</option>';
      foreach($data as $row)
      {
       $output .= '<option value="'.$row->CODE.'"> agence'.$row->CODE.'</option>';
      }

      echo $output;
   }

}




}
public function pdfhonorairreport (Request $request){
$date_debut=$request->input('date_debut');
$date_fin=$request->input('date_fin');
$codeexprt=$request->post('expert');

$date=date('y-m-d h:i:s');

$time = strtotime($date_debut);
$date_debt=date('y-m-d',$time);
$timefi = strtotime($date_fin);
$date_fi=date('y-m-d',$timefi);

if(auth::user()->previllege==="expert"){
  $expertid=Auth::user()->id;
  $experts_details = experts_details::where('id',$expertid)->first();
 $code= $experts_details->code;
}else{
  $experts_details = experts_details::where('code',$codeexprt)->first();

  $code= $codeexprt;
}

$Honoraire = Honoraire::join('expertise', 'expertise.id', '=', 'Honoraire.expertise_id')
->join('ods', 'ods.id', '=', 'expertise.id_ods')
->where('ods.code_expert', $code)
->whereBetween('expertise.date_expertise',array($date_debut,$date_fin))
->get();
$somme=0.0;
foreach ($Honoraire as $Honoraires) {
      $somme=$somme+$Honoraires->montant;
      }
return view('pdf_honorairetotal',compact('Honoraire','somme','code','date','experts_details','date_debut','date_fin'));
}
public function imprimer_pdf_honorairetotal(Request $request){

$date_debut=$request->post('date_debut');
$date_fin=$request->post('date_fin');
$date=date('y-m-d h:i:s');
$code=$request->post('code');

$time = strtotime($date_debut);
$date_debt=date('y-m-d',$time);
$timefi = strtotime($date_fin);
$date_fi=date('y-m-d',$timefi);

$experts_details = experts_details::where('code',$code)->first();
$expertid= $experts_details->id;
$Honoraire = Honoraire::join('expertise', 'expertise.id', '=', 'Honoraire.expertise_id')
->join('ods', 'ods.id', '=', 'expertise.id_ods')
->where('ods.code_expert', $code)
->whereBetween('expertise.date_expertise',array($date_debut,$date_fin))
->get();
$somme=0.0;
foreach ($Honoraire as $Honoraires) {
       $somme=$somme+$Honoraires->montant;
       }

   $pdf = PDF::loadView('pdf_honorairetotal',compact('Honoraire','somme','code','date','experts_details','date_debut','date_fin'));

return $pdf->stream();

}

public function detail($type){
    return view('detail.index',compact('type'));
}

public function detail_table(Request $request){

    $type=$request->type;

    $code_agence=Auth::user()->agences()->get();
    $code_agence=$code_agence->pluck('CODE')->toArray();
    $dossier_exlu=dossier_exlu::All()->pluck('id')->toArray();
    //dd($code_agence->toArray());
    if (Auth::user()->previllege==="expert"){
    $expert=experts_details::find(Auth::user()->id);
    $expertise=Expertise::Join('ods','expertise.id_ods','=','ods.id')
        ->select('expertise.id','ods.date_ods','ods.agence','ods.ref_sinistre','ods.expert')
        ->where('expertise.status',$type)
        ->where('ods.code_expert',$expert->code)
        ->whereNotIn('ods.id', $dossier_exlu);
    }
    if (Auth::user()->previllege==="agence" || Auth::user()->previllege==="dr"){
        $expertise=Expertise::Join('ods','expertise.id_ods','=','ods.id')
        ->select('expertise.id','ods.date_ods','ods.agence','ods.ref_sinistre','ods.expert')
        ->where('expertise.status',$type)
        ->whereIn('ods.agence',$code_agence)
        ->whereNotIn('ods.id', $dossier_exlu);
    }
    if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
        $expertise=Expertise::Join('ods','expertise.id_ods','=','ods.id')
        ->select('expertise.id','ods.date_ods','ods.agence','ods.ref_sinistre','ods.expert')
        ->where('expertise.status',$type)
        ->whereNotIn('ods.id', $dossier_exlu)
        ->get();
    }

    return datatables()->of($expertise)->addColumn('detail', function ($data) {
        return '<a href="'.route('expertise.show',$data->id).'" class="voir-detail btn btn-sm btn-primary" title="Voir détail"><i class="mdi mdi-information-variant"></i> </a>';
        })->rawColumns(['detail'])
                       ->make(true);

}

public function detail_ods(){
    return view('detail.ods');
}

public function detail_table_ods(Request $request){

    $code_agence=Auth::user()->agences()->get();
    $code_agence=$code_agence->pluck('CODE')->toArray();

    $tout_expertise=Expertise::All()->pluck('id_ods')->toArray();
    $dossier_exlu=dossier_exlu::All()->pluck('id')->toArray();

    if (Auth::user()->previllege==="expert"){
    $expert=experts_details::find(Auth::user()->id);
    $ods=Ods::whereNotIn('id', $tout_expertise)
        ->select('ods.date_ods','ods.agence','ods.ref_sinistre','ods.expert')
        ->where('ods.code_expert',$expert->code)
        ->whereNotIn('ods.id', $dossier_exlu);
    }
    if (Auth::user()->previllege==="agence" || Auth::user()->previllege==="dr"){
        $ods=Ods::whereNotIn('id', $tout_expertise)
        ->select('ods.date_ods','ods.agence','ods.ref_sinistre','ods.expert')
        ->whereIn('ods.agence',$code_agence)
        ->whereNotIn('ods.id', $dossier_exlu);
    }
    if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
        $ods=Ods::whereNotIn('id', $tout_expertise)
        ->select('ods.date_ods','ods.agence','ods.ref_sinistre','ods.expert')
        ->whereNotIn('ods.id', $dossier_exlu)
        ->get();
    }

    return datatables()->of($ods)
                       ->make(true);

}

public function devaliderFinal(Request $request, Expertise $expertise){
    $expertise =$expertise;

    if ($expertise->status != 3){
            Alert::warning('Avertissement', 'impossible de dévalider une expertise déja dévalider');
            return $this->creer(Request(),$expertise->id_ods,$expertise->id);

    }
    // if ($expertise->type == 1){
    //     $additif=Expertise::where('id_parent',$expertise->id)->get()->toArray();
    //     if($additif){
    //         Alert::warning('Avertissement', 'impossible de dévalider car un additif existe ! merci de supprimer l\'additif');
    //         return $this->creer(Request(),$expertise->id_ods,$expertise->id);
    //     }
    // }

    // if(!$request->motif_rejet){
    //         Alert::warning('Avertissement', 'Merci d\'insérer le motif de rejet');
    //         return $this->creer(Request(),$expertise->id_ods,$expertise->id);
    //     }

    $audit = new AuditAction();
    $audit->audit(auth()->user()->username,'devalidation final','Dévalidation pv id: '.$expertise->id);



    $expertise->update([
        'status'=>1,
    ]);
    $ods=ods::find($expertise->id_ods);
    $etat=ods_etat::where('id_ods',$ods->id);
        $etat->update(
            ['id_status' => 2]
        );
    $honoraire=Honoraire::where('expertise_id',$expertise->id)
                        ->whereIn('libelle',['honoraire','TVA']);
    $honoraire->delete();

    $num_expertise=NumExpertise::where('id_expertise',$expertise->id);
    $num_expertise->delete();

    $t=5;

    $when = Carbon::now()->addSeconds($t);

    $users = User::whereIn('previllege',['admin','backoffice','supbackoffice'])->get();

    $expert= experts_details::where('code',$ods->code_expert)->first();
    $user =User::find($expert->id);
    $users->push($user);

    //Notification::send($users, (new DevalidateExpertise($expertise->id))->delay($when));
    //Notification::send($users, (new DevalidateExpertise($expertise->id)));

    return redirect()->route('expertise.show',$expertise->id)
                                 ->withSuccess("l'expertise a été Dévalidée");

}

public function sendExlu(Request $request){


    $ods=ODS::find($request->id);
    if($ods){
        dossier_exlu::create([
            'id' => $ods->id,
            'ref_sinistre' => $ods->ref_sinistre
        ]);

    return redirect()->route('expertise.liste')->withSuccess("l'ODS a été Exclu !!");

    }

}


public function send_to_api(Expertise $expertise){

    $expertise =$expertise;
    $ods=ods::find($expertise->id_ods);
    $dossier = Dossier::where('ref_sinistre',$ods->ref_sinistre)->first();
    $photos = Photo::where('expertise_id',$expertise->id)->get();
    $honoraires = Honoraire::where('expertise_id',$expertise->id)->get();
    $chocs = Choc::where('expertise_id',$expertise->id)->get();
    $autre_expertise = AutreExpertise::where('expertise_id',$expertise->id)->first();

    $ref_sinistre = $ods->ref_sinistre;
    $model_pv = $expertise->type;
    $gravite = '';
    if($model_pv == 1){
        $gravite = 1;
    }else {
        $gravite = 2;
    }
    $username = 'n.tadbirt';
    $dr = $dossier ->dr;
    $agence = $dossier->agence;
    $code_expert = $ods->code_expert;
    $date_intervention = $expertise->date_expertise;
    $date_pv = $expertise->date_expertise;
    $description = $expertise->observation;

    //dd($ref_sinistre,$gravite,$username,$dr,$agence,$code_expert,$date_intervention,$date_pv,$description);

    $rubriques = [];
    $files = [];
    $id_honoraire='';

    /// photos
    foreach ($photos as $key => $photo) {
        array_push($files,
    [
        "id" => $key+1,
        "fileNom" => $photo->file,
        "fileType" => pathinfo($photo->file, PATHINFO_EXTENSION)

    ]);
    }


    /// rubriques

    // Valeur Estimée avant Siniste
    array_push($rubriques,
        [
            "type" => "1",
            "id" => 6,
            "nbr" => 1,
            "nbrJour" => null,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => $expertise->valeur_venal,
            "montantTotal" => $expertise->valeur_venal
        ]);

    // Epave
    array_push($rubriques,
        [
            "type" => "1",
            "id" => 7,
            "nbr" => 1,
            "nbrJour" => null,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => $autre_expertise->epave,
            "montantTotal" => $autre_expertise->epave
        ]);

    foreach ($chocs as $key => $choc) {

        // immobilisation
        array_push($rubriques,
        [
            "type" => "1",
            "id" => 5,
            "nbr" => null,
            "nbrJour" => $choc->immobilisation,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => 0,
            "montantTotal" => 0
        ]
    );

        // peinture
        array_push($rubriques,
        [
            "type" => "1",
            "id" => 3,
            "nbr" => 1,
            "nbrJour" => null,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => $choc->Autres,
            "montantTotal" => $choc->Autres
        ]
    );


        // main d'oeuvre
        array_push($rubriques,
        [
            "type" => "1",
            "id" => 2,
            "nbr" => null,
            "nbrJour" => null,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => $choc->main_oeuvre,
            "montantTotal" => $choc->main_oeuvre
        ]
    );

        // Fourniture (Hors BDG)
        array_push($rubriques,
        [
            "type" => "1",
            "id" => 8,
            "nbr" => 1,
            "nbrJour" => null,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => $expertise->MTC_expertise,
            "montantTotal" => $expertise->MTC_expertise
        ]
        );

    }



    /// honoraire
    foreach ($honoraires as $key => $honoraire) {
        if ($honoraire->libelle == "Déplacement véhicule personnel - 40 km"){
            $id_honoraire=4;
        }
        if ($honoraire->libelle == "Déplacement véhicule personnel >= 40 km"){
            $id_honoraire=5;
        }
        if ($honoraire->libelle == "Photos"){
            $id_honoraire=3;
        }
        if ($honoraire->libelle == "Frais de dossier"){
            $id_honoraire=6;
        }
        if ($honoraire->libelle == "Restauration"){
            $id_honoraire=8;
        }
        if ($honoraire->libelle == "Hébergement"){
            $id_honoraire=7;
        }
        if ($honoraire->libelle == "honoraire"){
            $id_honoraire=1;
        }
        array_push($rubriques,
        [
            "type" => "2",
            "id" => $id_honoraire,
            "nbr" => $honoraire->nombre,
            "nbrJour" => null,
            "nbrHeure" => null,
            "vituste" => null,
            "montantUnite" => $honoraire->montant/$honoraire->nombre,
            "montantTotal" => $honoraire->montant
        ]);

    }

    $tab = [
        "rubriques" => $rubriques,
        "files" => $files
    ];
    
    dd(json_encode($tab));

}

}
