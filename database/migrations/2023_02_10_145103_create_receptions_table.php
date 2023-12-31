<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receptions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('date_reception')->nullable();
            $table->tinyInteger('type_reception')->nullable()->comment('Provisoire, Definitif');
            $table->integer('duree_retard')->nullable();
            $table->float('taux_avancement', 10, 0)->nullable();
            $table->text('reception_doc')->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_receptions_dossiers_achats1_idx');
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
        Schema::dropIfExists('receptions');
    }
}
