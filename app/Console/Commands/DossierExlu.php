<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Ods;
use App\dossier_exlu;

class DossierExlu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dossierexclu';

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
        $allDossiers=dossier_exlu::All();
        foreach ($allDossiers as $dossier) {
            $ods=ODS::where('ref_sinistre',$dossier->ref_sinistre)->first();
            $dossier->update([
                'id' => $ods->id
            ]);
            print_r($dossier->id);
        }

        print_r('ok');
    }
}
