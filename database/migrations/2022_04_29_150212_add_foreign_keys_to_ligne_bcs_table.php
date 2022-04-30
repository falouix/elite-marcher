<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLigneBcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligne_bcs', function (Blueprint $table) {
            $table->foreign('bcs_engagements_id', 'fk_ligne_bcs_bcs_engagements1')->references('id')->on('bcs_engagements')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligne_bcs', function (Blueprint $table) {
            $table->dropForeign('fk_ligne_bcs_bcs_engagements1');
        });
    }
}
