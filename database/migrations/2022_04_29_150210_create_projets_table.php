<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->bigInteger('id', true)->comment('Projet d\'achat');
            $table->string('code_pa', 45)->nullable()->unique('code_pa_UNIQUE');
            $table->date('date_projet')->nullable();
            $table->string('annee_gestion', 4)->nullable();
            $table->string('objet')->nullable();
            $table->date('date_action_prevu')->nullable()->comment('تاريخ اعتزام التنفيذ');
            $table->string('type_demande', 10)->nullable()->comment('أشغال\nتزود بخدمات\nتزود بمواد\nدراسات\nENUM(\'TRAVAUX\', \'FOURNITURE_SERVICE\', \'FOURNITURE_BIEN\', \'ETUDES\')');
            $table->enum('nature_passation', ['CONSULTATION', 'AOS', 'AON', 'AOGREGRE'])->nullable()->comment('طريقة الإبرام\nإستشارة\nطلب عروض اجراءات مبسطة\nطلب عروض اجراءات عادية\nصفقة بالتفاوض المباشر');
            $table->bigInteger('services_id')->nullable();
            $table->boolean('transferer')->nullable();
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
        Schema::dropIfExists('projets');
    }
}
