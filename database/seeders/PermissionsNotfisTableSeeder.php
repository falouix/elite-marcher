<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsNotfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Notifs permissions

        Permission::create(
            [
                'name' => 'notifs-rappel',
                'name_en' => '',
                'name_ar' => 'الإطلاع على الإشعارات ',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'إشعارات التذكير',
            ]);
            Permission::create(
                [
                    'name' => 'notifs-rappel-action',
                    'name_en' => '',
                    'name_ar' => ' تثبيت الإشعارات ',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'إشعارات التذكير',
                ]);

        Permission::create(
            [
                'name' => 'notifs-validation',
                'name_en' => '',
                'name_ar' => 'الإطلاع على الإشعارات ',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'إشعارات المهام',
            ]);
            Permission::create(
                [
                    'name' => 'notifs-validation-action',
                    'name_en' => '',
                    'name_ar' => ' تثبيت الإشعارات ',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'إشعارات المهام',
                ]);

            Permission::create(
                [
                    'name' => 'notifs-message',
                    'name_en' => '',
                    'name_ar' => 'الإطلاع على الإشعارات',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'إشعارات أخرى',
                ]);
                Permission::create(
                    [
                        'name' => 'notifs-message-action',
                        'name_en' => '',
                        'name_ar' => ' تثبيت الإشعارات ',
                        'guard_name' => 'web',
                        'table_name_en' => '',
                        'table_name_ar' => 'إشعارات أخرى',
                    ]);
    }
}
