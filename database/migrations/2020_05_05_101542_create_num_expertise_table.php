<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumExpertiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('num_expertise', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_expertise');
            $table->string('num_pv');
            $table->string('code_expert');
            $table->string('code_agence');
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
        Schema::dropIfExists('num_expertise');
    }
}
