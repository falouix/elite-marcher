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
            $table->string('tel', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('code_pa', 45)->nullable();
            $table->string('code_consult', 45)->nullable();
            $table->string('code_aon', 45)->nullable();
            $table->string('code_aos', 45)->nullable();
            $table->string('code_gg', 45)->nullable();
            $table->boolean('ajouter_annee')->nullable()->default(1);
            $table->boolean('reset_code')->nullable()->default(1);
            $table->boolean('notif_validation_besoins')->nullable()->default(1);
            $table->boolean('notif_pa')->nullable()->default(1);
            $table->integer('notif_duree_pa')->nullable();
            $table->boolean('notif_publication_achat')->nullable();
            $table->integer('notif_duree_publication')->nullable();
            $table->boolean('notif_cc')->nullable();
            $table->integer('notif_duree_cc')->default(0)->comment('Cahier des Charges ');
            $table->tinyInteger('notif_avis_pub')->default(0);
            $table->integer('notif_duree_pub')->default(0);
            $table->boolean('notif_session_op')->nullable()->default(0)->comment('Session Overture Plis');
            $table->integer('notif_duree_session_op')->nullable();
            $table->boolean('notif_date_caution_final')->nullable()->default(0);
            $table->integer('notif_duree_caution_final')->nullable();
            $table->boolean('notif_caution_provisoire')->nullable()->default(0);
            $table->integer('notif_duree_caution_provisoire')->nullable();
            $table->boolean('notif_delais_rp')->nullable()->default(0)->comment('Reception provisoire');
            $table->integer('notif_duree_rp')->nullable();
            $table->boolean('notif_delais_rd')->nullable()->default(0)->comment('Reception defenitive');
            $table->integer('notif_duree_rd')->nullable();
            $table->boolean('notif_date_trsfert_ca_prvu')->nullable()->default(0);
            $table->integer('notif_duree_trsfert_ca_prvu')->nullable();
            $table->boolean('notif_date_trsfert_cao_prvu')->nullable()->default(0);
            $table->integer('notif_duree_trsfert_cao_prvu')->nullable();
            $table->tinyInteger('notif_date_pub_reslt_prvu')->nullable();
            $table->integer('notif_duree_pub_reslt_prvu')->nullable();
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
