<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLignesBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lignes_besoins', function (Blueprint $table) {
            $table->foreign('besoins_id', 'fk_lignes_besoins_besoins1')->references('id')->on('besoins')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lignes_besoins', function (Blueprint $table) {
            $table->dropForeign('fk_lignes_besoins_besoins1');
        });
    }
}
