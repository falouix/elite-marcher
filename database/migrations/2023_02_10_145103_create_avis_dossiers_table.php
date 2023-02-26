<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avis_dossiers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('date_avis')->nullable();
            $table->string('destination', 255)->nullable();
            $table->integer('duree_avis')->nullable();
            $table->dateTime('date_debut_avis')->nullable();
            $table->dateTime('date_validite')->nullable();
            $table->dateTime('date_ouverture_plis')->nullable();
            $table->string('ref_avis', 45)->nullable();
            $table->longText('texte_avis')->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_avis_dossiers_dossiers_achats1_idx');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avis_dossiers');
    }
}
