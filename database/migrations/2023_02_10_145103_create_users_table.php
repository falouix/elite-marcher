<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('adress')->nullable();
            $table->string('phone_num', 45)->nullable();
            $table->tinyInteger('active')->nullable()->default(1);
            $table->string('user_type', 45);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('avatar')->default('avatar.png');
            $table->string('messenger_color')->default('#2180f3');
            $table->boolean('dark_mode')->default(0);
            $table->boolean('active_status')->default(0);
            $table->bigInteger('services_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
