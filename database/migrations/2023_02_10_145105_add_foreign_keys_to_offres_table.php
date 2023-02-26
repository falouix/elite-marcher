<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->foreign('commissions_ops_id', 'fk_offres_commissions_ops1')->references('id')->on('commissions_ops')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('commissions_techniques_id', 'fk_offres_commissions_techniques1')->references('id')->on('commissions_techniques')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('dossiers_achats_id', 'fk_offres_dossiers_achats1')->references('id')->on('dossiers_achats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropForeign('fk_offres_commissions_ops1');
            $table->dropForeign('fk_offres_commissions_techniques1');
            $table->dropForeign('fk_offres_dossiers_achats1');
        });
    }
}
