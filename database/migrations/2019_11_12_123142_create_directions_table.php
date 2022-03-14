<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code',2)->unique();
            $table->char('libelle',100);
            $table->char('pere',2)->default('00');
            $table->char('statut',1)->default('1');
            $table->char('type',1)->default('2');
            $table->timestamps();
        });

        Schema::create('agence_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('libelle');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directions');
        Schema::dropIfExists('agence_type');
    }
}
