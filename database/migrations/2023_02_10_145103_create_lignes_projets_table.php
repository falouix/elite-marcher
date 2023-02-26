<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignesProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignes_projets', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('num_lot')->nullable();
            $table->text('libelle')->nullable();
            $table->integer('qte')->nullable();
            $table->decimal('cout_unite_ttc', 12, 3)->nullable();
            $table->decimal('cout_total_ttc', 12, 3)->nullable();
            $table->bigInteger('projets_id')->index('fk_lignes_projets_projets1_idx');
            $table->bigInteger('lignes_besoin_id')->default(0);
            $table->string('lbsoins_ids', 50)->default('0');
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
        Schema::dropIfExists('lignes_projets');
    }
}
