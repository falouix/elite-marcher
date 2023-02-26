<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCahiersChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cahiers_charges', function (Blueprint $table) {
            $table->integer('id', true);
            $table->tinyInteger('type_reception')->nullable()->comment('طريقة قبول العروض (منظومة الشراءات على الخط/مكتب الضبط/البريد)
');
            $table->tinyInteger('type_overture_plis')->nullable()->comment('طريقة فتح الظروف (مالية علنية، مالية وفنية علنية، مالية وفنية غير علنية)
');
            $table->float('prix_cc', 10, 0)->nullable();
            $table->integer('duree_travaux')->nullable();
            $table->float('caution_prov', 10, 0)->nullable();
            $table->integer('duree_caution_prov')->nullable();
            $table->float('caution_def', 10, 0)->nullable();
            $table->integer('duree_caution_def')->nullable();
            $table->float('autres_caution', 10, 0)->nullable();
            $table->integer('duree_autres_caution')->nullable();
            $table->date('date_pub_prevu')->nullable()->comment('تاريخ اعتزام النشر');
            $table->unsignedBigInteger('dossiers_achats_id')->index('fk_cahiers_charges_dossiers_achats1_idx');
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
        Schema::dropIfExists('cahiers_charges');
    }
}
