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
use App\Mail\SendMailExpertise;
use Mail;

class SendMailNewOds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendMailNewOds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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


     $mail= new SendMailExpertise();

     $user=User::find($expert->id);


     $agences = Agence::where('CODE',$od->agence)->first();
     $agence_user = agence_user::where('agence_id',$agences->id)->get(array('user_id'));


     $user2=User::whereIn('previllege', ['backoffice','supbackoffice'])
     ->orWhereIn('id',$agence_user)
     ->get();

     $mail->data=$expertise;
     $mail->action='créée';


     Mail::to($user)
      ->cc($user2)
      ->bcc('it-dev@allianceassirances.com.dz')
      ->send($mail);


     

     Ods_notif::create([
        'id_ods' => $od->id
     ]);

        }

    }
}
