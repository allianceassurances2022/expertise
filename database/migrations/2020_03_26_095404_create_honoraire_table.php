<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHonoraireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honoraire', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('expertise_id');
            $table->String('libelle');
            $table->float('nombre');
            $table->float('montant');
            $table->timestamps();
            $table->foreign('expertise_id')->references('id')->on('expertise')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('honoraire');
    }
}
