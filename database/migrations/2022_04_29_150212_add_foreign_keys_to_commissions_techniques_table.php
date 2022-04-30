<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommissionsTechniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commissions_techniques', function (Blueprint $table) {
            $table->foreign('dossiers_achats_id', 'fk_commissions_ops_dossiers_achats10')->references('id')->on('dossiers_achats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commissions_techniques', function (Blueprint $table) {
            $table->dropForeign('fk_commissions_ops_dossiers_achats10');
        });
    }
}
