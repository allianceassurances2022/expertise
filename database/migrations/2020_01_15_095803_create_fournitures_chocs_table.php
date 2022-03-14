<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournituresChocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournitures_chocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('choc_id');
            $table->unsignedBigInteger('piece_id');
            $table->integer('nb');
            $table->float('price');
            $table->float('total');
            $table->tinyInteger('statut')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('choc_id')->references('id')->on('agence')->onDelete('cascade');
            $table->foreign('piece_id')->references('id')->on('pieces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournitures_chocs');
    }
}
