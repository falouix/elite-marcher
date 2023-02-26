<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLignesNotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lignes_notifs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('users_ids')->default(0);
            $table->dateTime('read_at')->nullable();
            $table->unsignedBigInteger('notifs_id')->index('fk_lignes_notifs_notifs1_idx');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lignes_notifs');
    }
}
