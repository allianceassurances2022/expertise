<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disneyplus;
use PDF;

use App\Ods;
use App\Choc;
use App\Expertise;
use App\User;
use App\experts_details;
use App\FournituresChoc;

use App\Typechoc;
use App\Status_expertise;
use App\AutreExpertise;
use App\NumberFormatter;
use App\Tiers;
use App\NumExpertise;
use App\AutreFournituresChoc;


class DisneyplusController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }
    public function create()
    {

    }

    public function store()
    {

    }

    public function index()
    {

        return view('list');
    }

    public function downloadPDF($id) {

        $expertise=Expertise::where('id',$id)->first();
        $Status_expertise=Status_expertise::where('id',$expertise->status)->first();
        $ods=ods::where('id',$expertise->id_ods)->first();
        $tiers=tiers::where('ref_sinistre',$ods->ref_sinistre)->where('tiers',1)->first();
        $choc_list=Choc::where('expertise_id',$expertise->id)->orderBy('choc')->get();
        $AutreExpertise=AutreExpertise::where('expertise_id',$expertise->id)->first();
        $num_pv =NumExpertise::where('id_expertise',$expertise->id)->first();

        $premier_choc=Choc::where('expertise_id',$expertise->id)->orderBy('choc')->first();
        
        $plucked = $choc_list->pluck('id');

        $fourniture_list=FournituresChoc::leftJoin('pieces', 'fournitures_chocs.piece_id', '=','pieces.id')
        ->leftJoin('categoriespieces','pieces.cat_pieces','categoriespieces.id')
        ->select('fournitures_chocs.id','choc_id', 'intitule', 'categoriespieces.libelle', 'nb', 'price', 'total', 'statut')
        ->whereIn('choc_id',$plucked)->get();
        //dd($fourniture_list->toSql());

        $autre_fourniture=AutreFournituresChoc::whereIn('choc_id',$plucked)->get();
        $expert=experts_details::where('code',$ods->code_expert)->first();
        $sinistre=experts_details::where('code',$ods->code_expert)->first();
        $user=User::where('id',$expert->id)->first();


        // dd($choc_list);
        // dd($expert);
        if($expertise->model==1){
            $immobilisation=0;
            foreach ($choc_list as $choc) {
                $immobilisation = $immobilisation+$choc->immobilisation;
            }
            $a = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
            $arret=$a->format($expertise->MTC_expertise);
            $pdf = PDF::loadView('pdf', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','arret','immobilisation','num_pv','autre_fourniture','premier_choc'));
            //return view ('pdf', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','arret','immobilisation','num_pv'));
        }
        else if($expertise->model==2){
            $a = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
            $arret=$a->format($AutreExpertise->valeur-$AutreExpertise->service_epave);

            $pdf = PDF::loadView('pdf_reforme', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','AutreExpertise','arret','num_pv'));
            //return view('pdf_reforme', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','AutreExpertise','arret','num_pv'));
        }
        else if($expertise->model==3){
            $a = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
            $arret=$a->format($AutreExpertise->valeur-$AutreExpertise->service_epave);

            $pdf = PDF::loadView('pdf_vol', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','AutreExpertise','arret','num_pv'));
        }
        else if($expertise->model==4){
            $a = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
            $arret=$a->format($AutreExpertise->valeur-$AutreExpertise->service_epave);

            $pdf = PDF::loadView('pdf_incendie', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','AutreExpertise','arret','num_pv'));
        }
        else if($expertise->model==5){
            $a = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
            //$arret=$a->format($AutreExpertise->valeur-$AutreExpertise->service_epave);

            $pdf = PDF::loadView('pdf_ras', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','num_pv'));
            //return view('pdf_ras', compact('expertise','Status_expertise','ods','choc_list','expert','user','fourniture_list','tiers','arret','num_pv'));
        }
        else if($expertise->model==6){
            $a = new \NumberFormatter("fr", \NumberFormatter::SPELLOUT);
            //$arret=$a->format($AutreExpertise->valeur-$AutreExpertise->service_epave);

            $pdf = PDF::loadView('pdf_carence', compact('expertise','Status_expertise','AutreExpertise','ods','choc_list','expert','user','fourniture_list','tiers','num_pv'));

        }
        return $pdf->stream();

    }

}
