<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBcsEngagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bcs_engagements', function (Blueprint $table) {
            $table->foreign('dossiers_achats_id', 'fk_bcs_engagements_dossiers_achats1')->references('id')->on('dossiers_achats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bcs_engagements', function (Blueprint $table) {
            $table->dropForeign('fk_bcs_engagements_dossiers_achats1');
        });
    }
}
