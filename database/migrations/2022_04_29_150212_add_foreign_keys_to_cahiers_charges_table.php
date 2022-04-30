<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCahiersChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cahiers_charges', function (Blueprint $table) {
            $table->foreign('dossiers_achats_id', 'fk_cahiers_charges_dossiers_achats1')->references('id')->on('dossiers_achats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cahiers_charges', function (Blueprint $table) {
            $table->dropForeign('fk_cahiers_charges_dossiers_achats1');
        });
    }
}
