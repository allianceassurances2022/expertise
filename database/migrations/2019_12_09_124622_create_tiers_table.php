<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('ref_sinistre');
            $table->String('tiers');
            $table->String('nom')->nullable();
            $table->String('prenom')->nullable();
            $table->date('date_naissance')->nullable();
            $table->String('matricule')->nullable();
            $table->String('marque')->nullable();
            $table->String('model')->nullable();
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
        Schema::dropIfExists('tiers');
    }
}
