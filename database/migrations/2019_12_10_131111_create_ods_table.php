<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_ods');
            $table->string('ref_sinistre');
            $table->char('agence',5);
            $table->date('date_sinistre');
            $table->string('ref_police');
            $table->string('nom_tiers');
            $table->string('prenom_tiers');
            $table->date('date_ods');
            $table->string('expert');
            $table->string('matricule');
            $table->string('remarque');
            $table->string('marque');
            $table->string('model');
            $table->string('num_serie');
            $table->string('num_tel')->nullable();
            $table->boolean('etat')->default(1);
            $table->integer('status');
            $table->string('code_expert', 10);
            $table->string('num_tel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ods');
    }
}