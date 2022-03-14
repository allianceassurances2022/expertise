<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agence_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('agence_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('STATUT')->default(1);
            $table->timestamps();
            

             $table->foreign('agence_id')->references('id')->on('agence')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agence_users');
    }
}
