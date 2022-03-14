<?php

namespace App\Http\Controllers;

use App\Ods;
use App\Choc;
use App\Expertise;
use Illuminate\Http\Request;
use App\Status_expertise;
use App\AutreFournituresChoc;

class ChocController extends Controller
{
    //

    public function __construct()
	{
        $this->middleware('auth');
        $this->breadcrumb_lis_append(['title' => 'Liste des ODS en instances' , 'url' => 'expertise.liste', 'id' => '' ]);
    }

    public function creer( Expertise $expertise , $type)
    {
    	// $expertise =$expertise->with('ods')->first() ;
          // dd($expertise->id);
    	// dd($expertise);

        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $expertise->id ]);

         $breadcrumb_lis =  $this->breadcrumb_lis ;
        return view('choc.ajouter', compact('breadcrumb_lis','expertise', 'type'));
    }

    public function store(Request $request ,Expertise $expertise )
    {
        $formulaire = collect (json_decode($request->formulaire, true));
        $formulaire=$formulaire->pluck('value','name');
        $lignes = collect (json_decode($request->lignes, true));


        //return response()->json(['url' => $lignes ]);




            $total_choc= number_format( $lignes[0]['ODS_total'], 2, ',', '') ;
            $total_choc=$lignes[0]['ODS_total'];
        // return( $total_choc);
            $lignes2=$lignes[0]['ODS_lines2'];
            $lignes=$lignes[0]['ODS_lines'];


            //->pluck('value','name');


            //$lignes2=json_encode($lignes2, true);
            //return  json_encode($lignes2, true);
            //return count($lignes2);
            //return $lignes2[0]['libelle'];
            // foreach ($lignes2 as $value) {
            //   return $value['libelle'].'  '.$value['nb'] ;
            // }
            //return response()->json(['url' => $lignes2 ]);


            // return   $formulaire;

        // $ods=ods::where('ref_sinistre',$request->ref_sinistre)->get();
        // $nbr_ods=count($ods)+1;

        // // $expert=experts_details::where('code',$request->expert)->first();
        // $user=User::where('nom',$request->expert)->first();
        // $detail = experts_details::find($user->id);
        $non_tva = 0;
            if ( isset($formulaire['non_tva'])){
                $non_tva = 1;
            }else{
                $non_tva = 0;
            }

        $data = [
             'expertise_id' =>$expertise->id,
            // 'date_expertise' => $formulaire['date_expertise'],
            // 'heure_expertise' => $formulaire['heure_expertise'],
            //'lieu_axpertise' => $formulaire['lieu_expertise'],
            'choc' => $formulaire['type_choc'],
            'description' => $formulaire['description_choc'],
            'main_oeuvre' => $formulaire['main_oeuvre'],
            'immobilisation' => $formulaire['immobilisation'],
            // 'assure_fautif' => $formulaire['assure_fautif'],
            // 'suspicion_fraude' => $formulaire['suspicion_fraude'],
            // 'vol' => $formulaire['vol_vehicule'],
            'remarque' => $formulaire['remarque'],
            'etat' => 1,
            'total_fourniture'=> $total_choc,
            'Autres'=> $formulaire['Autres'],
            'non_tva' => $non_tva,
            'tva'  => $formulaire['TVA'],
            'vetuste'  => $formulaire['vetuste'],
            'vetuste_pneumatique'  => $formulaire['vetuste_pneumatique'],
            'MTC_choc' => $formulaire['MTC_choc']
        ];

        //if($this->validate($request, $rules)){
            $choc = Choc::create($data);
            $choc->fournitures()->attach($lignes);
            foreach ($lignes2 as $value) {
                $choc->autrefournitures()->create([
                     'libelle' =>  $value['libelle'],
                     'nb' =>  $value['nb'],
                     'price' =>  $value['price'],
                     'total' =>  $value['total'],
                     'user_id' => auth()->user()->id
                ]);
            }

            $choc->expertise()->update(['MTC_expertise'=> choc::where('expertise_id', $expertise->id)->sum('MTC_choc')
                                                //,'MHT_expertise'=> choc::where('expertise_id', $expertise->id)->sum('MHT_choc')
                                            ]);
            //Alert::message('L\'utilisateur a été ajouté');
            try{
                return response()->json(['url' => route('expertise.show',$choc->expertise_id ) ]);
            } catch (\Exception  $e) {
                 return response()->json(['Erreur' => $e->errorsMessage()->first() ], 403 );
            }

        // }
        // else{
        //     return redirect()->route('utilisateur.index')
        //                      ->withError("L'utilisateur n'a pas été ajouté, veuillez corriger les erreurs suivantes: ");
        // }
    }

public function show( Choc $choc)
{
    return $this->edit( $choc ,0);
}

public function edit( Choc $choc ,$edit=1)
    {
        $t = new \DateTime($choc->date_expertise );
        $t= $t->format('Y-m-d\TH:i');
        $choc->date_expertise = $t;
        // $stat = Status_expertise::select('libelle')->where('id', $choc->etat)->first();
        // $choc->etat = $stat->libelle ;
        $this->breadcrumb_lis_append(['title' => 'Expertise' , 'url' => 'expertise.show', 'id' => $choc->expertise_id ]);
        $expertise =Expertise::find($choc->expertise_id)->with('ods')->first() ;
        $breadcrumb_lis =  $this->breadcrumb_lis;
        return view('choc.edit', compact('breadcrumb_lis','expertise', 'choc','edit'));
    }

 public function update(Request $request ,Choc $choc )
    {
        $formulaire = collect (json_decode($request->formulaire, true));
         $formulaire=$formulaire->pluck('value','name');
        $lignes = collect (json_decode($request->lignes, true));

            $total_choc= number_format( $lignes[0]['ODS_total'], 2, ',', '') ;
            $total_choc=$lignes[0]['ODS_total'];
        // return( $total_choc);
            $lignes2=$lignes[0]['ODS_lines2'];
            $lignes=$lignes[0]['ODS_lines'];//->pluck('value','name');


            $non_tva = 0;
            if ( isset($formulaire['non_tva'])){
                $non_tva = 1;
            }else{
                $non_tva = 0;
            }

            $data = [

            // 'date_expertise' => $formulaire['date_expertise'],
            // 'heure_expertise' => $formulaire['heure_expertise'],
            // 'lieu_axpertise' => $formulaire['lieu_expertise'],

            'description' => $formulaire['description_choc'],
            'main_oeuvre' => $formulaire['main_oeuvre'],
            'immobilisation' => $formulaire['immobilisation'],
            // 'assure_fautif' => $formulaire['assure_fautif'],
            // 'suspicion_fraude' => $formulaire['suspicion_fraude'],
            // 'vol' => $formulaire['vol_vehicule'],
            'remarque' => $formulaire['remarque'],
             'etat' => 1,
            'total_fourniture'=> $total_choc,
            'Autres'=> $formulaire['Autres'],
            'non_tva' => $non_tva,
            'tva'  => $formulaire['TVA'],
            'vetuste'  => $formulaire['vetuste'],
            'vetuste_pneumatique'  => $formulaire['vetuste_pneumatique'],
            'MTC_choc' => $formulaire['MTC_choc']
        ];

        //if($this->validate($request, $rules)){
        try {
            $choc->update($data);
            $choc->fournitures()->sync($lignes);
            $choc->autrefournitures()->delete();
            foreach ($lignes2 as $value) {
                $choc->autrefournitures()->create([
                   'libelle' =>  $value['libelle'],
                   'nb' =>  $value['nb'],
                   'price' =>  $value['price'],
                   'total' =>  $value['total'],
                   'user_id' => auth()->user()->id
               ]);
            }
            $choc->expertise()->update(['MTC_expertise'=> choc::where('expertise_id', $choc->expertise_id)->sum('MTC_choc')
                                                //,'MHT_expertise'=> choc::where('expertise_id', $choc->expertise_id)->sum('MHT_choc')
        ]);
                    //Alert::message('L\'utilisateur a été ajouté');
            return response()->json(['url' => route('expertise.show',$choc->expertise_id ) ]);

        } catch (\Exception  $e) {
                 return response()->json(['Erreur' => $e->errorsMessage()->first() ], 403 );
            }

        // }
        // else{
        //     return redirect()->route('utilisateur.index')
        //                      ->withError("L'utilisateur n'a pas été ajouté, veuillez corriger les erreurs suivantes: ");
        // }
    }

    public function fournituresChoc( Choc $choc )
    {
        return $choc->fournitures()->select('fournitures_chocs.description','piece_id','price','nb','total','statut')->get();
    }

    public function AutrefournituresChoc( Choc $choc )
    {
        return $choc->autrefournitures()->select('libelle','price','nb','total','statut')->get();
    }

  public function info( Choc $choc )
    {
         $t = new \DateTime($choc->date_expertise );
        $t= $t->format('Y-m-d\TH:i');
        $choc->date_expertise = $t;
        // $stat = Status_expertise::select('libelle')->where('id', $choc->etat)->first();
        // $choc->etat = $stat->libelle ;
        return $choc;
    }

public function ValiderDevalider(Choc $choc, $act=2)
{
     return $choc->update(['etat' => $act]);
}

public function valider(Choc $choc)
{
    try {
            $this->ValiderDevalider($choc,2);
            if(Request()->ajax()) {
                  return response()->json(['url' => route('choc.edit',$choc->id ) ,
                                                'message' => 'le choc a été Valider' ] ,200);

               }
            return redirect()->route('choc.edit',$choc)
                                     ->withSuccess('le choc a été Valider');

            } catch (\Exception  $e) {
                if(Request()->ajax()) {
                  return response()->json(['url' => route('choc.edit',$choc->id ) ,
                                            'message' => 'le choc n\'a pas été Valider',
                                            'erreurs' =>  $e->getMessage() ] , 500);
               }
                 return redirect()->route('choc.edit',$choc)
                                 ->withErrors(['erreurs' =>  $e->getMessage() ]);
            }
}
public function devalider(Choc $choc)
{
    try {
            $this->ValiderDevalider($choc,1);
            if(Request()->ajax()) {
                  return response()->json(['url' => route('choc.edit',$choc->id ) ,
                                           'message' => 'le choc a été Dévalider' ] , 200);

               }
             return redirect()->route('choc.edit',$choc)
                              ->withSuccess('le choc a été Dévalider');

            } catch (\Exception  $e) {
                if(Request()->ajax()) {
                  return response()->json([ 'url' => route('choc.edit',$choc->id ) ,
                                            'message' => 'Erreur, le choc n\'a pas été Dévalider !!!',
                                            'erreurs' =>  $e->getMessage() ] ,500);

            }
               return redirect()->route('choc.edit',$choc)
                                ->withErrors(['erreurs' =>  $e->getMessage() ]);
            }
}

}
