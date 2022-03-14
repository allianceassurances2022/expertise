<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutreExpertiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autre_expertise', function (Blueprint $table) {
            $table->bigIncrements('id');
            //reste a ajouter les 3 nouvelles rubrique 'date_expertise','heure_expertise','lieu_expertise'
            $table->float('valeur')->nullable();
            $table->float('service_epave')->nullable();
            $table->float('prejudice')->nullable();
            $table->text(4)->nullable();
            $table->unsignedBigInteger('expertise_id');
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
        Schema::dropIfExists('autre_expertise');
    }
}
