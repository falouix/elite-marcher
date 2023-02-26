<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['VALIDATION', 'RAPPEL', 'MESSAGE'])->default('MESSAGE');
            $table->boolean('valider')->default(0);
            $table->text('texte');
            $table->text('user_group')->nullable();
            $table->bigInteger('user_service')->nullable();
            $table->string('from_table', 50)->nullable();
            $table->bigInteger('from_table_id')->nullable();
            $table->bigInteger('users_id');
            $table->date('read_at')->nullable();
            $table->text('action');
            $table->dateTime('date_action')->nullable();
            $table->bigInteger('traiter_par')->nullable();
            $table->dateTime('date_traitement')->nullable();
            $table->bigInteger('services_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifs');
    }
}
