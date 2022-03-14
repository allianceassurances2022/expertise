<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Ods;
use App\Ods_notif;
use App\Expertise;
use App\experts_details;
use App\User;
use App\Agence;
use App\agence_user;

class NouveauOdsNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendnew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoie mail pour nouveau ods';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ods_notif = Ods_notif::select('id_ods')->get()->toArray();
        $ods = Ods::whereNotIn('id',$ods_notif)->get();


        foreach ($ods as $od) {

        $expertise=Expertise::where('id_ods',$od->id)->first();

        $expert=experts_details::where('code',$od->code_expert)->first();


     //$mail= new SendMailExpertise();

     $user=User::find($expert->id);


     $agences = Agence::where('CODE',$od->agence)->first();
     $agence_user = agence_user::where('agence_id',$agences->id)->get(array('user_id'));


     $user2=User::whereIn('previllege', ['backoffice','supbackoffice'])
     ->orWhereIn('id',$agence_user)
     ->WhereNotIn('email',['smahdadi@allianceassurances.com.dz','lziaina@allianceassurances.com.dz','ssadaoui@allianceassurances.com.dz','cmatrah@allianceassurances.com.dz'])
     ->get();

     $to = $user->email;

     //$to = "delmedjadji@allianceassurances.com.dz";


     $subject = "E-Expertise";


     $listemail=implode(",", $user2->pluck('email')->toArray());

     //$listemail = "delmedjadji@allianceassurances.com.dz";

     //$url=route('expertise.show',$expertise->id);


     $txt = "Un nouveau ods a été affécté référence dossier : " .$od->ref_sinistre ;

     $txt=$txt." \r\n

     Contact client : ".$od->nom_tiers." ".$od->prenom_tiers." \r\n

     N° Tel  : ".$od->num_tel." \r\n

     ";

     $headers = "From: expertise" . "\r\n" .
     "CC:".$listemail. "\r\n" .
     "BCC:"."it-dev@allianceassurances.com.dz"
     ;

     mail($to,$subject,$txt,$headers);

     Ods_notif::create([
        'id_ods' => $od->id
     ]);

        }



    }
}
