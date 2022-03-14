<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('dr',3);
            $table->char('agence',5);
            $table->char('classe',2);
            $table->char('branche',4);
            $table->String('ref_sinistre');
            $table->date('date_sinistre');
            $table->String('matricule');
            $table->String('marque')->nullable();
            $table->String('model')->nullable();
            $table->String('ref_police');
            $table->date('date_effet');
            $table->date('date_expiration');
            $table->String('num_serie')->nullable();
            $table->String('assure');
            $table->String('detail')->nullable();
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
        Schema::dropIfExists('dossiers');
    }
}
