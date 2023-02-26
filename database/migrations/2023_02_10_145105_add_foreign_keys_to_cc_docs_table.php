<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCcDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cc_docs', function (Blueprint $table) {
            $table->foreign('cahiers_charges_id', 'fk_cc_docs_cahiers_charges1')->references('id')->on('cahiers_charges')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cc_docs', function (Blueprint $table) {
            $table->dropForeign('fk_cc_docs_cahiers_charges1');
        });
    }
}
