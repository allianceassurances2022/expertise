<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutreFournituresChocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autre_fournitures_chocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('choc_id');
            $table->text('libelle');
            $table->integer('nb');
            $table->float('price');
            $table->float('total');
            $table->tinyInteger('statut')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('choc_id')->references('id')->on('agence')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autre_fournitures_chocs');
    }
}
