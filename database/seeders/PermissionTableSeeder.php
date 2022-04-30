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
                'name' => 'appointement-list',
                'name_en' => 'Dashboard - Events',
                'name_ar' => ' الإطلاع على المواعيد',
                'guard_name' => 'web',
                'table_name_en' => 'Dashboard',
                'table_name_ar' => 'المخطط السنوي للشراءات',

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
        // besoin-offer permissions
        Permission::create(
            [
                'name' => 'besoin-offer-list',
                'name_en' => 'besoin offers List',
                'name_ar' => 'قائمة عروض الاتعاب',
                'guard_name' => 'web',
                'table_name_en' => 'ِِbesoin offers',
                'table_name_ar' => 'عروض الأتعاب',

            ]);
        Permission::create(
            [
                'name' => 'besoin-offer-create',
                'name_en' => 'besoin offers List',
                'name_ar' => 'إضافة عروض الاتعاب',
                'guard_name' => 'web',
                'table_name_en' => 'ِِbesoin offers',
                'table_name_ar' => 'عروض الأتعاب',

            ]);
        Permission::create(
            [
                'name' => 'besoin-offer-edit',
                'name_en' => 'besoin offers Edit',
                'name_ar' => 'تعديل عرض الاتعاب',
                'guard_name' => 'web',
                'table_name_en' => 'besoin offers',
                'table_name_ar' => 'عروض الأتعاب',

            ]);
        Permission::create(
            [
                'name' => 'besoin-offer-delete',
                'name_en' => 'besoin offers Delete',
                'name_ar' => 'حذف عروض الاتعاب',
                'guard_name' => 'web',
                'table_name_en' => 'besoin offers',
                'table_name_ar' => 'عروض الأتعاب',

            ]);

        // consultation permissions
        Permission::create(
            [
                'name' => 'consultation-list',
                'name_en' => 'Consultations List',
                'name_ar' => 'قائمة الإستشارات',
                'guard_name' => 'web',
                'table_name_en' => 'Consultations',
                'table_name_ar' => 'الإستشارات',
            ]);
        Permission::create(
            [
                'name' => 'consultation-view',
                'name_en' => 'Consultations View',
                'name_ar' => ' عرض تفاصيل الإستشارة',
                'guard_name' => 'web',
                'table_name_en' => 'Consultations',
                'table_name_ar' => 'الإستشارات',

            ]);
        Permission::create(
            [
                'name' => 'consultation-create',
                'name_en' => 'besoin offers Create',
                'name_ar' => 'إضافة إستشارة',
                'guard_name' => 'web',
                'table_name_en' => 'Consultations',
                'table_name_ar' => 'الإستشارات',

            ]);
        Permission::create(
            [
                'name' => 'consultation-edit',
                'name_en' => 'besoin offers Edit',
                'name_ar' => 'تعديل إستشارة',
                'guard_name' => 'web',
                'table_name_en' => 'Consultations',
                'table_name_ar' => 'الإستشارات',

            ]);
        Permission::create(
            [
                'name' => 'consultation-delete',
                'name_en' => 'besoin offers Delete',
                'name_ar' => 'حذف إستشارة',
                'guard_name' => 'web',
                'table_name_en' => 'Consultations',
                'table_name_ar' => 'الإستشارات',
            ]);
        // POA permissions
        Permission::create(
            [
                'name' => 'poa-list',
                'name_en' => 'Power Of Attorney List',
                'name_ar' => 'قائمة التوكيلات',
                'guard_name' => 'web',
                'table_name_en' => 'Power Of Attorney',
                'table_name_ar' => 'الوكالة',
            ]);
        Permission::create(
            [
                'name' => 'poa-view',
                'name_en' => 'Power Of Attorney View',
                'name_ar' => ' عرض تفاصيل الوكالة',
                'guard_name' => 'web',
                'table_name_en' => 'Power Of Attorney',
                'table_name_ar' => 'الوكالة',

            ]);
        Permission::create(
            [
                'name' => 'poa-create',
                'name_en' => 'Power Of Attorney Create',
                'name_ar' => 'إضافة وكالة',
                'guard_name' => 'web',
                'table_name_en' => 'Power Of Attorney',
                'table_name_ar' => 'الوكالة',

            ]);
        Permission::create(
            [
                'name' => 'poa-edit',
                'name_en' => 'Power Of Attorney Edit',
                'name_ar' => 'تعديل وكالة',
                'guard_name' => 'web',
                'table_name_en' => 'Power Of Attorney',
                'table_name_ar' => 'الوكالة',

            ]);
        Permission::create(
            [
                'name' => 'poa-delete',
                'name_en' => 'Power Of Attorney Delete',
                'name_ar' => 'حذف وكالة',
                'guard_name' => 'web',
                'table_name_en' => 'Power Of Attorney',
                'table_name_ar' => 'الوكالة',
            ]);
        // Standard Contract permissions
        Permission::create(
            [
                'name' => 'contract-list',
                'name_en' => 'Standard Contracts List',
                'name_ar' => 'قائمة العقود الأساسية',
                'guard_name' => 'web',
                'table_name_en' => 'Standard Contracts',
                'table_name_ar' => 'العقود الأساسية للتعديل',
            ]);
        Permission::create(
            [
                'name' => 'contract-view',
                'name_en' => 'Standard Contracts View',
                'name_ar' => ' عرض تفاصيل العقود الأساسية',
                'guard_name' => 'web',
                'table_name_en' => 'Standard Contracts',
                'table_name_ar' => 'العقود الأساسية للتعديل',

            ]);
        Permission::create(
            [
                'name' => 'contract-create',
                'name_en' => 'Standard Contracts Create',
                'name_ar' => 'إضافة عقد أساسي للتعديل',
                'guard_name' => 'web',
                'table_name_en' => 'Standard Contracts',
                'table_name_ar' => 'العقود الأساسية للتعديل',

            ]);
        Permission::create(
            [
                'name' => 'contract-edit',
                'name_en' => 'Standard Contracts Edit',
                'name_ar' => 'تعديل عقد أساسي',
                'guard_name' => 'web',
                'table_name_en' => 'Standard Contracts',
                'table_name_ar' => 'العقود الأساسية للتعديل',

            ]);
        Permission::create(
            [
                'name' => 'contract-delete',
                'name_en' => 'Standard Contracts Delete',
                'name_ar' => 'حذف عقد أساسي للتعديل',
                'guard_name' => 'web',
                'table_name_en' => 'Standard Contracts',
                'table_name_ar' => 'العقود الأساسية للتعديل',
            ]);
        // Standard Helpful Links permissions
        Permission::create(
            [
                'name' => 'heplfulLinks-list',
                'name_en' => 'Helpful Legal Links List',
                'name_ar' => 'قائمة الروابط القانونية المفيدة',
                'guard_name' => 'web',
                'table_name_en' => 'Heplful Legal Liniks',
                'table_name_ar' => 'روابط قانونية مفيدة',
            ]);
        Permission::create(
            [
                'name' => 'heplfulLinks-view',
                'name_en' => 'Heplful Legal Links View',
                'name_ar' => ' عرض رابط قانوني مفيد',
                'guard_name' => 'web',
                'table_name_en' => 'Heplful Legal Liniks',
                'table_name_ar' => 'روابط قانونية مفيدة',

            ]);
        Permission::create(
            [
                'name' => 'heplfulLinks-create',
                'name_en' => 'Heplful Legal Links Create',
                'name_ar' => 'إضافة رابط قانوني مفيد',
                'guard_name' => 'web',
                'table_name_en' => 'Heplful Legal Liniks',
                'table_name_ar' => 'روابط قانونية مفيدة',

            ]);
        Permission::create(
            [
                'name' => 'heplfulLinks-edit',
                'name_en' => 'Heplful Legal Links Edit',
                'name_ar' => 'تعديل رابط قانوني مفيد',
                'guard_name' => 'web',
                'table_name_en' => 'Heplful Legal Liniks',
                'table_name_ar' => 'روابط قانونية مفيدة',

            ]);
        Permission::create(
            [
                'name' => 'heplfulLinks-delete',
                'name_en' => 'Heplful Legal Links Delete',
                'name_ar' => 'حذف رابط قانوني مفيد',
                'guard_name' => 'web',
                'table_name_en' => 'Heplful Legal Liniks',
                'table_name_ar' => 'روابط قانونية مفيدة',
            ]);
        // Case permissions
        Permission::create(
            [
                'name' => 'case-list',
                'name_en' => 'Case List',
                'name_ar' => 'قائمة القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case',
                'table_name_ar' => 'القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-view',
                'name_en' => 'Case View',
                'name_ar' => ' عرض تفاصيل القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case',
                'table_name_ar' => 'القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-create',
                'name_en' => 'Case Create',
                'name_ar' => 'إضافة القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case',
                'table_name_ar' => 'القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-edit',
                'name_en' => 'Case Edit',
                'name_ar' => 'تعديل القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case',
                'table_name_ar' => 'القضايا',

            ]);
            Permission::create(
                [
                    'name' => 'case-edit-accountant',
                    'name_en' => 'Case Edit Accountant',
                    'name_ar' => 'تعديل القضايا بصفة محاسب',
                    'guard_name' => 'web',
                    'table_name_en' => 'Case',
                    'table_name_ar' => 'القضايا',

                ]);
        Permission::create(
            [
                'name' => 'case-partie-edit',
                'name_en' => 'Case Party Edit',
                'name_ar' => 'تعديل أطراف قضية',
                'guard_name' => 'web',
                'table_name_en' => 'Case',
                'table_name_ar' => 'القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-partie-delete',
                'name_en' => 'Case Party Delete',
                'name_ar' => 'حذف أطراف قضية',
                'guard_name' => 'web',
                'table_name_en' => 'Case',
                'table_name_ar' => 'القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-delete',
                'name_en' => 'Case Delete',
                'name_ar' => 'حذف القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'القضايا',

            ]);

        // Prosecution permissions
        Permission::create(
            [
                'name' => 'prosecution-list',
                'name_en' => 'Prosecution List',
                'name_ar' => 'قائمة النيابة العامة',
                'guard_name' => 'web',
                'table_name_en' => 'Prosecution',
                'table_name_ar' => 'النيابة العامة',

            ]);
        Permission::create(
            [
                'name' => 'prosecution-view',
                'name_en' => 'Prosecution View',
                'name_ar' => ' عرض تفاصيل النيابة العامة',
                'guard_name' => 'web',
                'table_name_en' => 'Prosecution',
                'table_name_ar' => 'النيابة العامة',

            ]);
        Permission::create(
            [
                'name' => 'prosecution-create',
                'name_en' => 'Prosecution Create',
                'name_ar' => 'إضافة النيابة العامة',
                'guard_name' => 'web',
                'table_name_en' => 'Prosecution',
                'table_name_ar' => 'النيابة العامة',

            ]);
        Permission::create(
            [
                'name' => 'prosecution-edit',
                'name_en' => 'Prosecution Edit',
                'name_ar' => 'تعديل النيابة العامة',
                'guard_name' => 'web',
                'table_name_en' => 'Prosecution',
                'table_name_ar' => 'النيابة العامة',

            ]);
        Permission::create(
            [
                'name' => 'prosecution-delete',
                'name_en' => 'Prosecution Delete',
                'name_ar' => 'حذف النيابة العامة',
                'guard_name' => 'web',
                'table_name_en' => 'Prosecution',
                'table_name_ar' => 'النيابة العامة',

            ]);
        // Add case documents permissions
        //....
        // Expense permissions
        Permission::create(
            [
                'name' => 'expense-list',
                'name_en' => 'Expense List',
                'name_ar' => 'قائمة المصروفات المستحقة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses',
                'table_name_ar' => 'المصروفات المستحقة',

            ]);
        Permission::create(
            [
                'name' => 'expense-create',
                'name_en' => 'Expense Create',
                'name_ar' => 'إضافة المصروفات المستحقة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses',
                'table_name_ar' => 'المصروفات المستحقة',

            ]);
        Permission::create(
            [
                'name' => 'expense-edit',
                'name_en' => 'Expense Edit',
                'name_ar' => 'تعديل المصروفات المستحقة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses',
                'table_name_ar' => 'المصروفات المستحقة',

            ]);
        Permission::create(
            [
                'name' => 'expense-delete',
                'name_en' => 'Expense Delete',
                'name_ar' => 'حذف المصروفات المستحقة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses',
                'table_name_ar' => 'المصروفات المستحقة',

            ]);
        // Expense Payement permissions
        Permission::create(
            [
                'name' => 'expense-payement-list',
                'name_en' => 'Expense payement List',
                'name_ar' => 'قائمة المصروفات المنجزة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses payement',
                'table_name_ar' => 'المصروفات المنجزة',

            ]);
        Permission::create(
            [
                'name' => 'expense-payement-create',
                'name_en' => 'Expense payement Create',
                'name_ar' => 'إضافة المصروفات المنجزة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses payement',
                'table_name_ar' => 'المصروفات المنجزة',

            ]);
        Permission::create(
            [
                'name' => 'expense-payement-edit',
                'name_en' => 'Expense payement Edit',
                'name_ar' => 'تعديل المصروفات المنجزة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses payement',
                'table_name_ar' => 'المصروفات المنجزة',

            ]);
        Permission::create(
            [
                'name' => 'expense-payement-delete',
                'name_en' => 'Expense payement Delete',
                'name_ar' => 'حذف المصروفات المنجزة',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses payement',
                'table_name_ar' => 'المصروفات المنجزة',

            ]);
        // Expense Type permissions
        Permission::create(
            [
                'name' => 'expense-type-list',
                'name_en' => 'Expense type List',
                'name_ar' => 'قائمة أقسام المصروفات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'أقسام المصروفات',

            ]);
        Permission::create(
            [
                'name' => 'expense-type-create',
                'name_en' => 'Expense type Create',
                'name_ar' => 'إضافة أقسام المصروفات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'أقسام المصروفات',

            ]);
        Permission::create(
            [
                'name' => 'expense-type-edit',
                'name_en' => 'Expense type Edit',
                'name_ar' => 'تعديل أقسام المصروفات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'أقسام المصروفات',

            ]);
        Permission::create(
            [
                'name' => 'expense-type-delete',
                'name_en' => 'Expense type Delete',
                'name_ar' => 'حذف أقسام المصروفات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'أقسام المصروفات',

            ]);
        // besoin Payement permissions
        Permission::create(
            [
                'name' => 'besoin-payement-list',
                'name_en' => 'besoin payement List',
                'name_ar' => 'قائمة المدفوعات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'المدفوعات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-payement-create',
                'name_en' => 'besoin payement Create',
                'name_ar' => 'إضافة المدفوعات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'المدفوعات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-payement-edit',
                'name_en' => 'besoin payement Edit',
                'name_ar' => 'تعديل المدفوعات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'المدفوعات',

            ]);
        Permission::create(
            [
                'name' => 'besoin-payement-delete',
                'name_en' => 'besoin payement Delete',
                'name_ar' => 'حذف المدفوعات',
                'guard_name' => 'web',
                'table_name_en' => 'Expenses type',
                'table_name_ar' => 'المدفوعات',

            ]);
        // Events permissions
        Permission::create(
            [
                'name' => 'event-list',
                'name_en' => 'EventS Control',
                'name_ar' => 'التحكم في المواعيد',
                'guard_name' => 'web',
                'table_name_en' => 'Events',
                'table_name_ar' => 'المواعيد',

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

        // Case-Type permissions
        Permission::create(
            [
                'name' => 'case-type-list',
                'name_en' => 'Case Type List',
                'name_ar' => 'قائمة أنواع القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);

        Permission::create(
            [
                'name' => 'case-type-create',
                'name_en' => 'Case Type Create',
                'name_ar' => 'إضافة أنواع القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-type-edit',
                'name_en' => 'Case Type Edit',
                'name_ar' => 'تعديل أنواع القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-type-delete',
                'name_en' => 'Case Type Delete',
                'name_ar' => 'حذف أنواع القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);

        // Case-Status permissions
        Permission::create(
            [
                'name' => 'case-status-list',
                'name_en' => 'Case Status List',
                'name_ar' => 'قائمة حالات القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'ِCase Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);

        Permission::create(
            [
                'name' => 'case-status-create',
                'name_en' => 'Case Status Create',
                'name_ar' => 'إضافة حالات القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'ِCase Status',
                'table_name_ar' => 'إعدادات القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-status-edit',
                'name_en' => 'Case Status Edit',
                'name_ar' => 'تعديل حالات القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'ِCase Status',
                'table_name_ar' => 'إعدادات  القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-status-delete',
                'name_en' => 'Case Status Delete',
                'name_ar' => 'حذف حالات القضايا',
                'guard_name' => 'web',
                'table_name_en' => 'ِCase Status',
                'table_name_ar' => ' إعدادات القضايا',
            ]);

        // Case-Stage permissions
        Permission::create(
            [
                'name' => 'case-stage-list',
                'name_en' => 'Case stage List',
                'name_ar' => 'قائمة مراحل التقاضي',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);

        Permission::create(
            [
                'name' => 'case-stage-create',
                'name_en' => 'Case stage Create',
                'name_ar' => 'إضافة مراحل التقاضي',
                'guard_name' => 'web',
                'table_name_en' => 'Case stage',
                'table_name_ar' => 'إعدادات القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-stage-edit',
                'name_en' => 'Case stage Edit',
                'name_ar' => 'تعديل مراحل التقاضي',
                'guard_name' => 'web',
                'table_name_en' => 'ِCase stage',
                'table_name_ar' => 'إعدادات  القضايا',

            ]);
        Permission::create(
            [
                'name' => 'case-stage-delete',
                'name_en' => 'Case stage Delete',
                'name_ar' => 'حذف مراحل التقاضي',
                'guard_name' => 'web',
                'table_name_en' => 'ِCase stage',
                'table_name_ar' => ' إعدادات القضايا',
            ]);
        // Court/Circle permissions
        Permission::create(
            [
                'name' => 'court-list',
                'name_en' => 'Court/Circle List',
                'name_ar' => 'قائمة محكمة/دائرة',
                'guard_name' => 'web',
                'table_name_en' => 'Case Types',
                'table_name_ar' => 'إعدادات القضايا',

            ]);

        Permission::create(
            [
                'name' => 'court-create',
                'name_en' => 'Court/Circle Create',
                'name_ar' => 'إضافة محكمة/دائرة',
                'guard_name' => 'web',
                'table_name_en' => 'Court/Circle',
                'table_name_ar' => 'إعدادات القضايا',

            ]);
        Permission::create(
            [
                'name' => 'court-edit',
                'name_en' => 'Court/Circle Edit',
                'name_ar' => 'تعديل محكمة/دائرة',
                'guard_name' => 'web',
                'table_name_en' => 'ِCourt/Circle',
                'table_name_ar' => 'إعدادات  القضايا',

            ]);
        Permission::create(
            [
                'name' => 'court-delete',
                'name_en' => 'Court/Circle Delete',
                'name_ar' => 'حذف محكمة/دائرة',
                'guard_name' => 'web',
                'table_name_en' => 'ِCourt/Circle',
                'table_name_ar' => ' إعدادات القضايا',
            ]);

        /*************************************** */

        // besoin-Type permissions
        Permission::create(
            [
                'name' => 'besoin-type-list',
                'name_en' => 'besoin Type List',
                'name_ar' => 'قائمة أنواع العملاء',
                'guard_name' => 'web',
                'table_name_en' => 'ِbesoins Types',
                'table_name_ar' => 'إعدادات العملاء',

            ]);

        Permission::create(
            [
                'name' => 'besoin-type-create',
                'name_en' => 'besoin Type Create',
                'name_ar' => 'إضافة أنواع العملاء',
                'guard_name' => 'web',
                'table_name_en' => 'ِbesoins Types',
                'table_name_ar' => 'إعدادات العملاء',

            ]);
        Permission::create(
            [
                'name' => 'besoin-type-edit',
                'name_en' => 'besoin Type Edit',
                'name_ar' => 'تعديل أنواع العملاء',
                'guard_name' => 'web',
                'table_name_en' => 'ِbesoins Types',
                'table_name_ar' => 'إعدادات العملاء',

            ]);
        Permission::create(
            [
                'name' => 'besoin-type-delete',
                'name_en' => 'besoin Type Delete',
                'name_ar' => 'حذف أنواع العملاء',
                'guard_name' => 'web',
                'table_name_en' => 'ِbesoins Types',
                'table_name_ar' => 'إعدادات العملاء',

            ]);

        // payement-status permissions
        /*         Permission::create(
    [
    'name' => 'payement-status-list',
    'name_en' => 'besoin Payements List',
    'name_ar' => 'قائمة دفوعات العملاء',
    'guard_name' => 'web',
    'table_name_en' => 'ِِbesoin Payements',
    'table_name_ar' => 'دفوعات العملاء',

    ]);
    Permission::create(
    [
    'name' => 'payement-status-view',
    'name_en' => 'besoin Payements View',
    'name_ar' => ' عرض تفاصيل دفوعات العملاء',
    'guard_name' => 'web',
    'table_name_en' => 'ِbesoin Payements',
    'table_name_ar' => 'دفوعات العملاء',

    ]);
    Permission::create(
    [
    'name' => 'payement-status-create',
    'name_en' => 'besoin Payements Create',
    'name_ar' => 'إضافة أنواع القضايا',
    'guard_name' => 'web',
    'table_name_en' => 'ِbesoin Payements',
    'table_name_ar' => 'دفوعات العملاء',

    ]);
    Permission::create(
    [
    'name' => 'payement-status-edit',
    'name_en' => 'besoin Payements Edit',
    'name_ar' => 'تعديل أنواع القضايا',
    'guard_name' => 'web',
    'table_name_en' => 'ِbesoin Payements',
    'table_name_ar' => 'دفوعات العملاء',

    ]);
    Permission::create(
    [
    'name' => 'payement-status-delete',
    'name_en' => 'besoin Payements Delete',
    'name_ar' => 'حذف أنواع القضايا',
    'guard_name' => 'web',
    'table_name_en' => 'ِbesoin Payements',
    'table_name_ar' => 'دفوعات العملاء',

    ]);
     */

    }
}
