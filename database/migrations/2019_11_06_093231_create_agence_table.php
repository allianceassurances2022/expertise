<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //['DG',    'DR',    'CODE',   tinyInteger 'N_ANNEXE',    'TYPE_AGENCE',    'TGVA',    'STATUT',    'CHEF_AGENCE',    'EMAIL']
        Schema::create('agence', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->char('DG',2);
            $table->char('DR',3);
            $table->char('CODE',5);
            $table->Integer('N_ANNEXE');
            $table->Integer('TYPE_AGENCE');
            $table->char('TGVA',5);
            $table->tinyInteger('STATUT');
            $table->char('CHEF_AGENCE',80)->nullable();
            $table->char('EMAIL',80)->nullable();

          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agence');
    }
    
}