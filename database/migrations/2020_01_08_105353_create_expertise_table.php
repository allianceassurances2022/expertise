<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expertise', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('id_ods'); 
            $table->double('MTC_expertise');
            $table->double('MHT_expertise');
            $table->tinyInteger('statut')->default(1);
            $table->tinyInteger('type')->default(1);
            $table->Integer('id_parent');
            $table->integer('num_expertise')->default(1);
            $table->tinyInteger('model');
            $table->string('code')->nullable();
            //reste a ajouter les 3 nouvelles rubrique 'date_expertise','heure_expertise','lieu_expertise'
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
        Schema::dropIfExists('expertise');
    }
}