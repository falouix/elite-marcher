<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Dashboard
        Permission::create(
            [
                'name' => 'dashboard-list',
                'name_en' => 'Dashboard',
                'name_ar' => 'الرئيسية',
                'guard_name' => 'web',
                'table_name_en' => 'Dashboard',
                'table_name_ar' => 'الرئيسية',

            ]);

        Permission::create(
            [
                'name' => 'statistic-list',
                'name_en' => 'Dashboard',
                'name_ar' => 'الإطلاع على الإحصائيات',
                'guard_name' => 'web',
                'table_name_en' => 'Dashboard',
                'table_name_ar' => 'الرئيسية',

            ]);
        Permission::create(
            [
                'name' => 'pai',
                'name_en' => '',
                'name_ar' => 'المخطط السنوي للشراءات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',

            ]);

        // Besoins
        Permission::create(
            [
                'name' => 'besoins-list',
                'name_en' => 'besoins',
                'name_ar' => 'ظبط الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',
            ]);
        Permission::create(
            [
                'name' => 'besoin-view',
                'name_en' => 'besoin view',
                'name_ar' => 'عرض تفاصيل الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',
            ]);
        Permission::create(
            [
                'name' => 'besoin-create',
                'name_en' => 'besoin Create',
                'name_ar' => 'إضافة الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-edit',
                'name_en' => 'besoin Edit',
                'name_ar' => 'تعديل الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-delete',
                'name_en' => 'besoin Delete',
                'name_ar' => 'حذف الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-validate',
                'name_en' => 'besoin Validate',
                'name_ar' => 'المصادقة على الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'المخطط السنوي للشراءات',
                'table_name_ar' => 'المخطط السنوي للشراءات',

            ]);
        // bمشاريع الشراءات permissions
        Permission::create(
            [
                'name' => 'projet-achat',
                'name_en' => '',
                'name_ar' => 'مشاريع الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مشاريع الشراءات',

            ]);
        Permission::create(
            [
                'name' => 'projet-achat-view',
                'name_en' => 'pojet achat view',
                'name_ar' => 'عرض تفاصيل مشاريع الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مشاريع الشراءات',
            ]);
        Permission::create(
            [
                'name' => 'projet-achat-create',
                'name_en' => 'projet achat Create',
                'name_ar' => 'إضافة مشاريع الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مشاريع الشراءات',
            ]);
        Permission::create(
            [
                'name' => 'projet-achat-edit',
                'name_en' => 'projet achat Edit',
                'name_ar' => 'تعديل مشاريع الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مشاريع الشراءات',

            ]);
        Permission::create(
            [
                'name' => 'projet-achat-delete',
                'name_en' => 'projet achat Delete',
                'name_ar' => 'حذف مشاريع الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مشاريع الشراءات',
            ]);

        Permission::create(
            [
                'name' => 'preparation-dossier-achat',
                'name_en' => '',
                'name_ar' => 'إعداد ملف شراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'المخطط السنوي للشراءات',

            ]);
        // Dossier Achtas permissions
        Permission::create(
            [
                'name' => 'dossier-achat',
                'name_en' => '',
                'name_ar' => 'ملفات الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'ملفات الشراءات',

            ]);
        Permission::create(
            [
                'name' => 'dossier-achat-view',
                'name_en' => '',
                'name_ar' => 'عرض ملف شراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'ملفات الشراءات',

            ]);
        Permission::create(
            [
                'name' => 'dossier-achat-create',
                'name_en' => '',
                'name_ar' => 'إضافة ملف شراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'ملفات الشراءات',

            ]);
        Permission::create(
            [
                'name' => 'dossier-achat-edit',
                'name_en' => '',
                'name_ar' => 'تعديل ملف شراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'ملفات الشراءات',

            ]);
        Permission::create(
            [
                'name' => 'dossier-achat-delete',
                'name_en' => '',
                'name_ar' => 'حذف ملف شراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'ملفات الشراءات',

            ]);

        // Settings permissions
        Permission::create(
            [
                'name' => 'settings-general',
                'name_en' => 'Settings Control',
                'name_ar' => 'إعدادات النظام',
                'guard_name' => 'web',
                'table_name_en' => 'Settings',
                'table_name_ar' => 'التحكم في في منطقة الإعدادات',

            ]);
        // Settings permissions
        Permission::create(
            [
                'name' => 'settings-update',
                'name_en' => 'Settings Control',
                'name_ar' => 'ظبط إعدادات النظام',
                'guard_name' => 'web',
                'table_name_en' => 'Settings',
                'table_name_ar' => 'إعدادات النظام',

            ]);
        // User permissions
        Permission::create(
            [
                'name' => 'user-list',
                'name_en' => 'User List',
                'name_ar' => 'قائمة المستخدمين',
                'guard_name' => 'web',
                'table_name_en' => 'Users',
                'table_name_ar' => 'المستخدمين',

            ]);
        Permission::create(
            [
                'name' => 'user-view',
                'name_en' => 'User View',
                'name_ar' => ' عرض تفاصيل المستخدم',
                'guard_name' => 'web',
                'table_name_en' => 'Users',
                'table_name_ar' => 'المستخدمين',

            ]);
        Permission::create(
            [
                'name' => 'user-create',
                'name_en' => 'User Create',
                'name_ar' => 'إضافة المستخدمين',
                'guard_name' => 'web',
                'table_name_en' => 'Users',
                'table_name_ar' => 'المستخدمين',

            ]);
        Permission::create(
            [
                'name' => 'user-edit',
                'name_en' => 'User Edit',
                'name_ar' => 'تعديل المستخدمين',
                'guard_name' => 'web',
                'table_name_en' => 'Users',
                'table_name_ar' => 'المستخدمين',

            ]);
        Permission::create(
            [
                'name' => 'user-delete',
                'name_en' => 'User Delete',
                'name_ar' => 'حذف المستخدمين',
                'guard_name' => 'web',
                'table_name_en' => 'Users',
                'table_name_ar' => 'المستخدمين',

            ]);

        // Role permissions
        Permission::create(
            [
                'name' => 'role-list',
                'name_en' => 'Role List',
                'name_ar' => 'قائمة الصلاحيات',
                'guard_name' => 'web',
                'table_name_en' => 'Roles',
                'table_name_ar' => 'الصلاحيات',

            ]);

        Permission::create(
            [
                'name' => 'role-create',
                'name_en' => 'Role create',
                'name_ar' => 'إضافة صلاحيات',
                'guard_name' => 'web',
                'table_name_en' => 'Roles',
                'table_name_ar' => 'الصلاحيات',

            ]);
        Permission::create(
            [
                'name' => 'role-edit',
                'name_en' => 'Role Edit',
                'name_ar' => 'تعديل الصلاحيات',
                'guard_name' => 'web',
                'table_name_en' => 'Roles',
                'table_name_ar' => 'الصلاحيات',

            ]);
        Permission::create(
            [
                'name' => 'role-delete',
                'name_en' => 'Role Delete',
                'name_ar' => 'حذف الصلاحيات',
                'guard_name' => 'web',
                'table_name_en' => 'Roles',
                'table_name_ar' => 'الصلاحيات',

            ]);



    }
}
