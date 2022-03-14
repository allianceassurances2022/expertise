<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->tinyInteger('etat')->default(1);
            $table->string('previllege')->default('utilisateur');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('profil_update')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
