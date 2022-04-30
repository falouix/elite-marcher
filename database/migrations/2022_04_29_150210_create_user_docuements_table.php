<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDocuementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_docuements', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->unsignedBigInteger('user_id')->index('fk_user_docuements_users1_idx');

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
        Schema::dropIfExists('user_docuements');
    }
}
