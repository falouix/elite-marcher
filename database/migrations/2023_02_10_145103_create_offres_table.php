<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('ref_offre', 45)->nullable();
            $table->tinyInteger('source_offre')->nullable()->comment('وصول العرض(Tuneps، موقع المؤسسة، مواقع أخرى)
');
            $table->dateTime('date_arrive')->nullable();
            $table->dateTime('date_enregistrement')->nullable();
            $table->string('ref_bo', 45)->nullable()->comment('Reference bureau d\'ordre');
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_offres_dossiers_achats1_idx');
            $table->bigInteger('soumissionaire_id')->nullable();
            $table->integer('nbr_lots')->nullable();
            $table->decimal('prix_offre', 15, 3)->nullable();
            $table->string('decision_op', 45)->nullable();
            $table->text('observations')->nullable();
            $table->bigInteger('commissions_ops_id')->nullable()->index('fk_offres_commissions_ops1_idx');
            $table->string('decision_technique', 45)->nullable();
            $table->bigInteger('commissions_techniques_id')->nullable()->index('fk_offres_commissions_techniques1_idx');
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
        Schema::dropIfExists('offres');
    }
}
