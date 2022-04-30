<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTechniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions_techniques', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('num_session', 45)->nullable();
            $table->tinyInteger('type_session')->nullable()->comment('فنية ومالية. فنية . مالية');
            $table->date('date_session')->nullable();
            $table->string('agent_ids', 45)->nullable();
            $table->bigInteger('dossiers_achats_id')->index('fk_commissions_ops_dossiers_achats1_idx');
            $table->string('libelle_pv', 45)->nullable();
            $table->text('path_pv')->nullable();
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
        Schema::dropIfExists('commissions_techniques');
    }
}
