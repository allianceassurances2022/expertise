<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expertise;

use Illuminate\Support\Facades\Auth;
use App\experts_details;
use App\Ods;
use App\dossier_exlu;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $breadcrumb_lis =   $this->breadcrumb_lis ;

      if(Auth()->user()->profil_update == 0)
        return redirect()->route('utilisateur.profil');

        $nouveau = '';
        $draft ='';
        $valide ='';
        $finalise ='';


        $code_agence=Auth::user()->agences()->get();
        $code_agence=$code_agence->pluck('CODE')->toArray();

        $tout_expertise=Expertise::All()->pluck('id_ods')->toArray();
        $dossier_exlu=dossier_exlu::All()->pluck('id')->toArray();


        if (Auth::user()->previllege==="expert"){
        $expert=experts_details::find(Auth::user()->id);
        $nouveau = Ods::whereNotIn('id', $tout_expertise)->where('ods.code_expert',$expert->code)->whereNotIn('id', $dossier_exlu)->count();
        $draft = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','1')->where('ods.code_expert',$expert->code)->whereNotIn('ods.id', $dossier_exlu)->count();
        $valide = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','2')->where('ods.code_expert',$expert->code)->whereNotIn('ods.id', $dossier_exlu)->count();
        $finalise = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','3')->where('ods.code_expert',$expert->code)->whereNotIn('ods.id', $dossier_exlu)->count();
        }
        if (Auth::user()->previllege==="agence" || Auth::user()->previllege==="dr"){
        $nouveau = Ods::whereNotIn('id', $tout_expertise)->whereIn('ods.agence',$code_agence)->whereNotIn('id', $dossier_exlu)->count();
        $draft = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','1')->whereIn('ods.agence',$code_agence)->whereNotIn('ods.id', $dossier_exlu)->count();
        $valide = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','2')->whereIn('ods.agence',$code_agence)->whereNotIn('ods.id', $dossier_exlu)->count();
        $finalise = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','3')->whereIn('ods.agence',$code_agence)->whereNotIn('ods.id', $dossier_exlu)->count();
        }
        if (Auth::user()->previllege==="admin" or Auth::user()->previllege==="backoffice" or Auth::user()->previllege==="supbackoffice"){
        $nouveau = Ods::whereNotIn('id', $tout_expertise)->whereNotIn('id', $dossier_exlu)->count();
        $draft = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','1')->whereNotIn('ods.id', $dossier_exlu)->count();
        $valide = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','2')->whereNotIn('ods.id', $dossier_exlu)->count();
        $finalise = Expertise::Join('ods','expertise.id_ods','=','ods.id')->where('expertise.status','3')->whereNotIn('ods.id', $dossier_exlu)->count();
        }

        return view('index',compact('breadcrumb_lis','nouveau','draft','valide','finalise'));
    }
}
