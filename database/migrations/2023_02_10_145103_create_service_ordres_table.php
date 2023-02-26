<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrdresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_ordres', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('date_ordre')->nullable();
            $table->date('date_reception_ordre')->nullable();
            $table->string('ref_ordre')->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_service_ordres_dossiers_achats1_idx');
            $table->bigInteger('soumissionnaires_id')->nullable();
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
        Schema::dropIfExists('service_ordres');
    }
}
