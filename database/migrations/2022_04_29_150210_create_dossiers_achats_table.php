<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersAchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers_achats', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->bigInteger('code_projet')->nullable();
            $table->string('code_dossier', 45)->nullable()->unique('code_dossier_UNIQUE');
            $table->integer('situation_dossier')->nullable()->comment('بصدد الإعداد 1\n، في انتظار العروض2\n في الفرز،3\n بصدد الإنجاز،4\n القبول الوقتي، 5\nالقبول النهائي،6\n ملف منتهي 7\n، ملغى');
            $table->text('objet_dossier')->nullable();
            $table->string('organisme_financier')->nullable()->comment('ميزانية الدولة');
            $table->integer('source_finance')->nullable()->comment('طريقة التمويل \nميزانية الدولة، قرض، هبة');
            $table->enum('nature_finance', ['FIXE', 'DYNAMIQUE'])->nullable()->comment('طبيعة الأسعار (ثابتة، قابلة للمراجعة)\n');
            $table->boolean('type_dossier')->nullable()->comment('0 : Consultation\n1 : Appel Offre(إجراءات مبسطو . عادية. تفاوض مباشر)');
            $table->string('type_demande', 10)->nullable()->comment('أشغال\nتزود بخدمات\nتزود بمواد\nدراسات\nENUM(\'TRAVAUX\', \'FOURNITURE_SERVICE\', \'FOURNITURE_BIEN\', \'ETUDES\')');
            $table->string('type_commission', 45)->nullable()->comment('لجنة الصفقات (محلية، جهوية، وطنية)');
            $table->date('date_cloture')->nullable();
            $table->string('dossiers_achatscol', 45)->nullable();
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
        Schema::dropIfExists('dossiers_achats');
    }
}
