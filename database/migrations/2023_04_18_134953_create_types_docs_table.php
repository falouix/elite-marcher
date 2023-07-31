<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types_docs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('libelle')->nullable();
            $table->enum('type_doc', ['RECEPTION_OFFRES', 'SESSION_OP', 'COM_OPTECH', 'ENGAGEMENT', 'ENREGISTREMENT', 'ORDRE_SERVICE', 'RECEPTIONPROVISOIRE', 'RECEPTIONDEFINITIVE', 'CLOTURE', 'ANNULATION', 'AUTRES_CA', 'AUTRES_CAO'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types_docs');
    }
}
