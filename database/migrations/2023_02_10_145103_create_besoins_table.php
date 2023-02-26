<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besoins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('annee_gestion', 4)->nullable();
            $table->date('date_besoin')->nullable();
            $table->boolean('valider')->nullable();
            $table->dateTime('date_validation')->nullable();
            $table->text('doc_validation')->nullable();
            $table->bigInteger('services_id')->index('fk_besoins_services_idx');
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
        Schema::dropIfExists('besoins');
    }
}
