<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annulations', function (Blueprint $table) {
            $table->date('date_annul')->nullable();
            $table->date('date_decision')->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_annulations_dossiers_achats1');
            $table->unsignedBigInteger('soumissionnaires_id');
            $table->text('annul_doc');
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
        Schema::dropIfExists('annulations');
    }
}
