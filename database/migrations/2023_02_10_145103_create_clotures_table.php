<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCloturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clotures', function (Blueprint $table) {
            $table->date('date_cloure')->nullable();
            $table->float('montant_origin', 10, 0)->nullable();
            $table->float('montant_final', 10, 0)->nullable();
            $table->integer('duree_travaux_prv')->nullable();
            $table->integer('duree_travaux_reel')->nullable();
            $table->integer('duree_pause_travaux')->nullable();
            $table->float('taux_penanlite', 10, 0)->nullable();
            $table->float('montant_penalite', 10, 0)->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_clotures_dossiers_achats1_idx');
            $table->bigInteger('soumissionnaires_id')->nullable();
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
        Schema::dropIfExists('clotures');
    }
}
