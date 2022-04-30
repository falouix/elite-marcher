<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignesBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignes_besoins', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->text('libelle')->nullable();
            $table->integer('qte_demande')->nullable();
            $table->decimal('cout_unite_ttc', 12, 3)->nullable();
            $table->decimal('cout_total_ttc', 12, 3)->nullable();
            $table->integer('qte_valide')->nullable();
            $table->bigInteger('besoins_id')->index('fk_lignes_besoins_besoins1_idx');
            $table->bigInteger('projets_id')->nullable();
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
        Schema::dropIfExists('lignes_besoins');
    }
}
