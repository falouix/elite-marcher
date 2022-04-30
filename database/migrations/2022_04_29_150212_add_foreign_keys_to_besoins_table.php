<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBesoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('besoins', function (Blueprint $table) {
            $table->foreign('services_id', 'fk_besoins_services')->references('id')->on('services')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('besoins', function (Blueprint $table) {
            $table->dropForeign('fk_besoins_services');
        });
    }
}
