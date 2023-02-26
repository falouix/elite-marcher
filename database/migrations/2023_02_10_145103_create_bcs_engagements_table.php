<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcsEngagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bcs_engagements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('date_bc')->nullable();
            $table->date('date_avis_bc')->nullable();
            $table->integer('destination_avis')->nullable()->comment('Tuneps، موقع المؤسسة، مواقع أخرى');
            $table->string('ref_avis')->nullable();
            $table->string('num_carte_desc')->nullable();
            $table->integer('type_carte_desc')->nullable()->comment('وصفية أولى، محينة');
            $table->date('data_visa')->nullable();
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_bcs_engagements_dossiers_achats1_idx');
            $table->unsignedBigInteger('soumissionaire_id');
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
        Schema::dropIfExists('bcs_engagements');
    }
}
