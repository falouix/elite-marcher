<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoumissionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soumissionnaires', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('libelle', 45)->nullable();
            $table->string('matricule_fiscale', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('adresse')->nullable();
            $table->string('contact', 45)->nullable();
            $table->string('code_postal', 6)->nullable();
            $table->string('gouvernorat', 45)->nullable();
            $table->string('ville', 45)->nullable();
            $table->string('tel_fax', 45)->nullable();
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
        Schema::dropIfExists('soumissionnaires');
    }
}
