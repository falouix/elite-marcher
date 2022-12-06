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
                'name_ar' => '(dashboard)الإطلاع على الإحصائيات',
                'guard_name' => 'web',
                'table_name_en' => 'Dashboard',
                'table_name_ar' => 'الرئيسية',

            ]);
            Permission::create(
                [
                    'name' => 'dossiers-list',
                    'name_en' => 'dossiers-Dashboard',
                    'name_ar' => '(dashboard)الإطلاع على ملفات الصفقات',
                    'guard_name' => 'web',
                    'table_name_en' => 'Dashboard',
                    'table_name_ar' => 'الرئيسية',

                ]);

        Permission::create(
            [
                'name' => 'besoins',
                'name_en' => '',
                'name_ar' => 'تحديد الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',

            ]);

        // Besoins
        Permission::create(
            [
                'name' => 'besoins-list',
                'name_en' => 'besoins',
                'name_ar' => 'ظبط الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',
            ]);
        Permission::create(
            [
                'name' => 'besoin-create',
                'name_en' => 'besoin Create',
                'name_ar' => 'إضافة الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-edit',
                'name_en' => 'besoin Edit',
                'name_ar' => 'تعديل الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',
            ]);
        Permission::create(
            [
                'name' => 'besoin-validate',
                'name_en' => 'besoin Validate',
                'name_ar' => 'المصادقة على الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-view',
                'name_en' => 'besoin view',
                'name_ar' => 'عرض تفاصيل الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',
            ]);
        Permission::create(
            [
                'name' => 'besoin-delete',
                'name_en' => 'besoin Delete',
                'name_ar' => 'حذف الحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',
            ]);
        Permission::create(
            [
                'name' => 'besoin-add-special',
                'name_en' => 'besoin Validate',
                'name_ar' => 'إضافة إستثنائية للحاجيات',
                'guard_name' => 'web',
                'table_name_en' => 'تحديد الحاجيات',
                'table_name_ar' => 'تحديد الحاجيات',

            ]);
            Permission::create(
                [
                    'name' => 'besoin-file-edit',
                    'name_en' => '',
                    'name_ar' => 'التصرف في ملف/وثيقة ضبط الحاجيات',
                    'guard_name' => 'web',
                    'table_name_en' => 'تحديد الحاجيات',
                    'table_name_ar' => 'تحديد الحاجيات',
                ]);
            Permission::create(
                [
                    'name' => 'pai',
                    'name_en' => 'pai',
                    'name_ar' => 'المخطط السنوي للحاجيات',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'تحديد الحاجيات',
                ]);

        // bمشاريع الشراءات permissions
        Permission::create(
            [
                'name' => 'projet-achat',
                'name_en' => '',
                'name_ar' => 'البرنامج السنوي للشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'البرنامج السنوي للشراءات',

            ]);
            Permission::create(
                [
                    'name' => 'projet-achat-list',
                    'name_en' => '',
                    'name_ar' => 'قائمة مشاريع الشراءات',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'البرنامج السنوي للشراءات',

                ]);
                Permission::create(
                    [
                    'name' => 'projet-ppm',
                    'name_en' => '',
                    'name_ar' => 'عرض تفاصيل البرنامج السنوي للشراءات',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'البرنامج السنوي للشراءات',

                ]);
        Permission::create(
            [
                'name' => 'projet-achat-create',
                'name_en' => 'projet achat Create',
                'name_ar' => 'إضافة مشروع الشراءات',
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
                'name' => 'projet-achat-view',
                'name_en' => 'pojet achat view',
                'name_ar' => 'عرض تفاصيل مشروع الشراءات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مشاريع الشراءات',
            ]);
            Permission::create(
                [
                    'name' => 'ppm',
                    'name_en' => 'ppm',
                    'name_ar' => 'المخطط السنوي الشراءات',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => 'مشاريع الشراءات',
                ]);

        Permission::create(
            [
                'name' => 'projet-achat-delete',
                'name_en' => 'projet achat Delete',
                'name_ar' => 'حذف مشروع الشراءات',
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
                'table_name_ar' => 'مشاريع الشراءات',

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
        // Consultations
        Permission::create(
            [
                'name' => 'consultations-list',
                'name_en' => '',
                'name_ar' => 'قائمة الإستشارات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإستشارات]ملفات الشراءات',
            ]);

        Permission::create(
            [
                'name' => 'consultations-edit',
                'name_en' => '',
                'name_ar' => 'تعديل إستشارة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإستشارات]ملفات الشراءات',
            ]);
            Permission::create(
                [
                    'name' => 'consultations-view',
                    'name_en' => '',
                    'name_ar' => 'عرض تفاصيل إستشارة',
                    'guard_name' => 'web',
                    'table_name_en' => '',
                    'table_name_ar' => '[الإستشارات]ملفات الشراءات',
                ]);
        Permission::create(
            [
                'name' => 'consultations-delete',
                'name_en' => '',
                'name_ar' => 'حذف إستشارة ',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإستشارات]ملفات الشراءات',
            ]);
        Permission::create(
            [
                'name' => 'consultations-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة الإستشارات',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإستشارات]طلبات العروض',
            ]);

        // Appels d'offres simplifiés
        Permission::create(
            [
                'name' => 'AOS-list',
                'name_en' => '',
                'name_ar' => 'قائمة طلب عروض إجراءات مبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات المبسطة]طلبات العروض',
            ]);

        Permission::create(
            [
                'name' => 'AOS-edit',
                'name_en' => '',
                'name_ar' => 'تعديل طلب عروض إجراءات مبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات المبسطة]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOS-view',
                'name_en' => '',
                'name_ar' => 'عرض تفاصيل طلب عروض إجراءات مبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات المبسطة]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOS-delete',
                'name_en' => '',
                'name_ar' => 'حذف طلب عروض إجراءات مبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات المبسطة]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOS-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة طلب عروض بالإجراءات المبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات المبسطة]طلبات العروض',
            ]);

        // Appels d'offres Normal
        Permission::create(
            [
                'name' => 'AON-list',
                'name_en' => '',
                'name_ar' => 'قائمة طلب عروض إجراءات مبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات العادية]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AON-edit',
                'name_en' => '',
                'name_ar' => 'تعديل طلب عروض إجراءات مبسطة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات العادية]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AON-view',
                'name_en' => '',
                'name_ar' => 'عرض تفاصيل طلب عروض إجراءات عادية',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات العادية]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AON-delete',
                'name_en' => '',
                'name_ar' => 'حذف طلب عروض إجراءات عادية',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات العادية]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AON-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة طلب عروض بالإجراءات عادية',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[الإجراءات العادية]طلبات العروض',
            ]);
        // Appels d'offres GRE GRE
        Permission::create(
            [
                'name' => 'AOGREGRE-list',
                'name_en' => '',
                'name_ar' => 'قائمة طلب عروض بالتفاوض المباشر',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التفاوض المباشر]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOGREGRE-edit',
                'name_en' => '',
                'name_ar' => 'تعديل طلب عروض بالتفاوض المباشر',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التفاوض المباشر]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOGREGRE-view',
                'name_en' => '',
                'name_ar' => 'تعديل طلب عروض بالتفاوض المباشر',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التفاوض المباشر]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOGREGRE-delete',
                'name_en' => '',
                'name_ar' => 'تعديل طلب عروض بالتفاوض المباشر',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التفاوض المباشر]طلبات العروض',
            ]);
        Permission::create(
            [
                'name' => 'AOGREGRE-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة طلب عروض التفاوض المباشر',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التفاوض المباشر]طلبات العروض',
            ]);
        // مراحل إنجاز طلبات العروض
        // Cahiers Charges
        Permission::create(
            [
                'name' => 'cc-add',
                'name_en' => '',
                'name_ar' => 'إضافة كراس الشروط',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'cc-edit',
                'name_en' => '',
                'name_ar' => 'تعديل كراس الشروط',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => 'مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'cc-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف كراس الشروط',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[كراس الشروط]مراحل إنجاز ملف صفقة',
            ]);
        // إعلان إشهاري
        Permission::create(
            [
                'name' => 'avisPub-add',
                'name_en' => '',
                'name_ar' => 'إضافة إعلان إشهاري',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إعلان إشهاري]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'avisPub-edit',
                'name_en' => '',
                'name_ar' => 'تعديل إعلان إشهاري',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إعلان إشهاري]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'avisPub-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف الإعلان إشهاري',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إعلان إشهاري]مراحل إنجاز ملف صفقة',
            ]);
// وصول العروض

        Permission::create(
            [
                'name' => 'receptionOffres-add',
                'name_en' => '',
                'name_ar' => 'إضافة عرض',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[وصول العروض]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'receptionOffres-edit',
                'name_en' => '',
                'name_ar' => 'تعديل عرض',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[وصول العروض]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'receptionOffres-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة العرض ',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[وصول العروض]مراحل إنجاز ملف صفقة',
            ]);

// جلسات فتح الضروف
        Permission::create(
            [
                'name' => 'comissionOP-add',
                'name_en' => '',
                'name_ar' => 'إضافة جلسة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[جلسات فتح الضروف]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'comissionOP-edit',
                'name_en' => '',
                'name_ar' => 'تعديل جلسة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[جلسات فتح الضروف]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'comissionOP-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة جلسة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[جلسات فتح الضروف]مراحل إنجاز ملف صفقة',
            ]);
// جلسات الفرز
        Permission::create(
            [
                'name' => 'comissionTech-add',
                'name_en' => '',
                'name_ar' => 'إضافة جلسة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[جلسات الفرز]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'comissionTech-edit',
                'name_en' => '',
                'name_ar' => 'تعديل جلسة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[جلسات الفرز]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'comissionTech-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة جلسة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[جلسات الفرز]مراحل إنجاز ملف صفقة',
            ]);

//  Engamement إسناد صفقة
        Permission::create(
            [
                'name' => 'engagement-add',
                'name_en' => '',
                'name_ar' => 'إضافة تعهد/إسناد صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[تعهد/إسناد صفقة]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'engagement-edit',
                'name_en' => '',
                'name_ar' => 'تعديل تعهد/إسناد صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[تعهد/إسناد صفقة]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'engagement-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة تعهد/إسناد صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[تعهد/إسناد صفقة]مراحل إنجاز ملف صفقة',
            ]);
//  Enregistrement تسجيل صفقة
        Permission::create(
            [
                'name' => 'enregistrement-add',
                'name_en' => '',
                'name_ar' => 'إضافة تسجيل صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[تسجيل صفقة]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'enregistrement-edit',
                'name_en' => '',
                'name_ar' => 'تعديل تسجيل صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[تسجيل صفقة]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'enregistrement-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة تسجيل صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[تسجيل صفقة]مراحل إنجاز ملف صفقة',
            ]);
//  ordre Service  إذن بداية أشغال
        Permission::create(
            [
                'name' => 'oredreService-add',
                'name_en' => '',
                'name_ar' => 'إضافة إذن بداية أشغال',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إذن بداية أشغال]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'oredreService-edit',
                'name_en' => '',
                'name_ar' => 'تعديل تسجيل صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إذن بداية أشغال]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'oredreService-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة إذن بداية أشغال',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إذن بداية أشغال]مراحل إنجاز ملف صفقة',
            ]);
        //  Reception Provisoire  القبول الوقتي
        Permission::create(
            [
                'name' => 'receptionProvisoire-add',
                'name_en' => '',
                'name_ar' => 'إضافة قبول وقتي',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[القبول الوقتي]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'receptionProvisoire-edit',
                'name_en' => '',
                'name_ar' => 'تعديل قبول وقتي',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[القبول الوقتي]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'receptionProvisoire-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة القبول الوقتي',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[القبول الوقتي]مراحل إنجاز ملف صفقة',
            ]);
        //  Reception Définitive  القبول النهائي
        Permission::create(
            [
                'name' => 'receptionDef-add',
                'name_en' => '',
                'name_ar' => 'إضافة قبول نهائي',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[القبول النهائي]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'receptionDef-edit',
                'name_en' => '',
                'name_ar' => 'تعديل قبول نهائي',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[القبول النهائي]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'receptionDef-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة القبول النهائي',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[القبول النهائي]مراحل إنجاز ملف صفقة',
            ]);

        //ِِCloture التسوية النهائية
        Permission::create(
            [
                'name' => 'cloture-add',
                'name_en' => '',
                'name_ar' => 'إضافة تسوية نهائية',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التسوية النهائية]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'cloture-edit',
                'name_en' => '',
                'name_ar' => 'تعديل تسوية نهائية',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التسوية النهائية]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'cloture-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة التسوية النهائية',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[التسوية النهائية]مراحل إنجاز ملف صفقة',
            ]);
        //Annulation  إلغاء صفقة
        Permission::create(
            [
                'name' => 'annulation-add',
                'name_en' => '',
                'name_ar' => 'إضافة إلغاء صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إلغاء صفقة]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'annulation-edit',
                'name_en' => '',
                'name_ar' => 'تعديل إلغاء صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إلغاء صفقة]مراحل إنجاز ملف صفقة',
            ]);
        Permission::create(
            [
                'name' => 'annulation-file-edit',
                'name_en' => '',
                'name_ar' => 'التصرف في ملف/وثيقة إلغاء صفقة',
                'guard_name' => 'web',
                'table_name_en' => '',
                'table_name_ar' => '[إلغاء صفقة]مراحل إنجاز ملف صفقة',
            ]);
            //
            Permission::create(
    [
        'name' => 'comission-ao-achat',
        'name_en' => '',
        'name_ar' => 'التصرف في اللجان المختصة',
        'guard_name' => 'web',
        'table_name_en' => '',
        'table_name_ar' => 'اللجان المختصة',
    ]);
// لجنة الصفقات
Permission::create(
    [
        'name' => 'comission-ao-list',
        'name_en' => '',
        'name_ar' => 'التصرف في لجنة الصفقات',
        'guard_name' => 'web',
        'table_name_en' => '',
        'table_name_ar' => 'اللجان المختصة',
    ]);
// لجنة الشراءات
Permission::create(
    [
        'name' => 'comission-achat-list',
        'name_en' => '',
        'name_ar' => 'التصرف في لجنة الشراءات',
        'guard_name' => 'web',
        'table_name_en' => '',
        'table_name_ar' => 'اللجان المختصة',
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
