<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDossierDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dossier_docs', function (Blueprint $table) {
            $table->foreign('dossiers_achats_id', 'fk_dossier_docs_dossiers_achats1')->references('id')->on('dossiers_achats')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossier_docs', function (Blueprint $table) {
            $table->dropForeign('fk_dossier_docs_dossiers_achats1');
        });
    }
}
