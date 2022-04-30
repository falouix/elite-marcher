<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToServiceOrdresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_ordres', function (Blueprint $table) {
            $table->foreign('dossiers_achats_id', 'fk_service_ordres_dossiers_achats1')->references('id')->on('dossiers_achats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_ordres', function (Blueprint $table) {
            $table->dropForeign('fk_service_ordres_dossiers_achats1');
        });
    }
}
