<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts_details', function (Blueprint $table) {
            $table->integer('id');
            $table->string('code', 10);
            $table->string('adresse', 100);
            $table->string('wilaya_designation', 50);
            $table->string('wilaya_code', 3);
            $table->string('ville_designation', 50);
            $table->string('ville_code', 6);
            $table->string('telephone_1', 25);
            $table->string('telephone_2', 25);
            $table->string('agerement_organisme', 6);
            $table->string('agrement_date_obtention', 50);
            $table->tinyInteger('auto');
            $table->tinyInteger('risque_indu');
            $table->tinyInteger('transport');
            $table->tinyInteger('tva');
            $table->string('nif',100);
            $table->string('rib',100);
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
        Schema::dropIfExists('experts_details');
    }
}
