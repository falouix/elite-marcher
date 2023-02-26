<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoleHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->foreign('permission_id', 'FK_role_has_permissions_marche_db.permissions')->references('id')->on('permissions')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign('role_id', 'FK_role_has_permissions_marche_db.roles')->references('id')->on('roles')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->dropForeign('FK_role_has_permissions_marche_db.permissions');
            $table->dropForeign('FK_role_has_permissions_marche_db.roles');
        });
    }
}
