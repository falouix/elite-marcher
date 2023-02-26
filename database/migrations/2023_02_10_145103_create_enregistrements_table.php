<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnregistrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enregistrements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('date_signature')->nullable();
            $table->date('date_enregistrement')->nullable();
            $table->date('date_copie_unique')->nullable();
            $table->string('ref_copie_unique', 50)->nullable();
            $table->integer('type_enregistrement')->nullable()->default(1)->comment('صفقة مرهونة، صفقة غير مرهونة');
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_enregistrements_dossiers_achats1_idx');
            $table->unsignedBigInteger('soumissionnaires_id');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enregistrements');
    }
}
