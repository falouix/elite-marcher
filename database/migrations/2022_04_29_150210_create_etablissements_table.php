<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtablissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('libelle', 45)->nullable();
            $table->string('matricule_fiscale', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('adresse')->nullable();
            $table->string('responsable', 45)->nullable();
            $table->string('entete', 45)->nullable();
            $table->string('code_pa', 45)->nullable();
            $table->string('code_consult', 45)->nullable();
            $table->string('code_ao', 45)->nullable();
            $table->boolean('ajouter_annee')->nullable()->default(1);
            $table->boolean('reset_code')->nullable()->default(1);
            $table->boolean('notif_validation_besoins')->nullable()->default(1);
            $table->boolean('notif_pa')->nullable();
            $table->integer('notif_duree_pa')->nullable();
            $table->boolean('notif_publication_achat')->nullable();
            $table->integer('notif_duree_publication')->nullable();
            $table->boolean('notif_session_op')->nullable()->comment('Session Overture Plis');
            $table->integer('notif_duree_session_op')->nullable();
            $table->boolean('notif_date_caution_final')->nullable();
            $table->integer('notif_duree_caution_final')->nullable();
            $table->boolean('notif_delais_rp')->nullable()->comment('Reception provisoire');
            $table->integer('notif_duree_rp')->nullable();
            $table->boolean('notif_delais_rd')->nullable()->comment('Reception defenitive');
            $table->integer('notif_duree_rd')->nullable();
            $table->date('datedeb_besoin')->nullable();
            $table->date('datefin_besoin')->nullable();
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
        Schema::dropIfExists('etablissements');
    }
}
