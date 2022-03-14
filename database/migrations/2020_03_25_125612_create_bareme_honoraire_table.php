<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaremeHonoraireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bareme_honoraire', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('montant_a');
            $table->float('montant_b');
            $table->float('minimum');
            $table->float('maximum');
            $table->float('sur_a');
            $table->float('sur_b');
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
        Schema::dropIfExists('bareme_honoraire');
    }
}
