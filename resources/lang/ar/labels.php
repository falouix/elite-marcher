<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
     */
  // Buttons
  'lbl_role' => 'صلاحيات المستخدم ',
  'lbl_libelle_role' => 'إسم الصلاحية ',
  'lbl_libelle_role_ar' => 'إسم الصلاحية بالعربية',

  // Swal Delete
  'swal_delete_title' => 'هل تريد فعلا حذف هذا التسجيل ؟',
  'swal_delete_text' => 'بمجرد الحذف, لا يمكن إستعادة هذا التسجيل',
  'swal_confirm_btn' => 'تأكيد الحذف',
  'swal_create_account_btn' => 'إضافة حساب',
  'swal_suspend_account_btn' => 'تجميد حساب',
  'swal_cancel_btn' => 'إلغاء',
  'swal_warning_title' => '!تنبيه',
  'swal_delete_users_warning_text' => 'الرجاء إختيار مستعمل على الأقل للحذف',
  'swal_delete_clients_warning_text' => 'الرجاء إختيار عميل على الأقل للحذف',
  'swal_delete_cases_warning_text' => 'الرجاء إختيار قضية على الأقل للحذف',
  'swal_create_account' => 'إضافة حساب للمزود',
  'swal_suspend_account' => 'تجميد حساب المزود',
  'swal_create_account_info_text' => 'هل تريد فعلا تفعيل حساب المزود ؟',
  'swal_suspend_account_info_text' => 'هل تريد فعلا تجميد حساب المزود ؟',
  'swal_error_title' => 'خطأ',
  'swal_error_event_star_end_date' => 'الرجاء الثتبت من تاريخ البداية وتاريخ النهاية',
  'swal_error_colors' => 'لون الخط و لون الخلفية متطابقان',
  // Pnotify
  'pnotify_title' => 'جاري عملية الحذف',

  // tables
  /***** User Table */
  'tbl_qin' => 'رقم التعريف القطري',
  'tbl_name' => '[عربي]الإسم بالكامل',
  'tbl_name_en' => '[English]الإسم بالكامل',
  'tbl_password' => 'كلمة السر',
  'tbl_confirm_password' => 'تأكيد كلمة السر',
  'tbl_passport' => 'رقم جواز السفر',
  'tbl_description' => 'الملاحظات',
  'tbl_phone' => 'الهاتف',
  'tbl_role' => 'الصلاحيات',
  'tbl_start_date' => 'تاريخ المباشرة',
  'tbl_end_date' => 'تاريخ المغادرة',
  'tbl_action' => 'قرار',

  /***** Case Table */
  'tbl_case_num' => 'رقم القضية',
  'tbl_case_code' => 'كود القضية',
  'tbl_case_date' => 'تاريخ القضية',
  'tbl_case_type_id' => 'نوع القضية',
  'tbl_description' => 'تفاصيل / ملاحظات', // Case Contract
  'tbl_court_id' => 'المحكمة',
  'tbl_court_num' => 'دائرة المحكمة',
  'tbl_lawyer_id' => 'المحامي المختص',
  'tbl_case_status_id' => 'حالة القضية',
  'tbl_case_stage_id' => 'مرحلة التقاضي',
  'tbl_case_amount' => 'مبلغ القضية',

  /*****Client Table */
  'tbl_client_code' => 'رقم رمز العميل',
  'tbl_client_nationality' => 'الجنسية',
  'tbl_client_cp_name' => '[عربي] إسم الشركة',
  'tbl_client_cp_name_en' => 'إسم الشركة[English]',
  'tbl_client_cp_registration' => 'رقم تسجيل الشركة',
  'tbl_client_cp_phone_num' => 'رقم هاتف الشركة',
  'tbl_client_cp_adress' => 'عنوان الشركة',
  'tbl_client_adress' => 'العنوان ',
  'tbl_client_cp_email' => ' البريد الإلكتروني للشركة',
  'tbl_client_name' => '[عربي]إسم العميل',
  'tbl_client_name_en' => '[English] إسم العميل',
  'tbl_client_phone' => 'رقم الهاتف',
  'tbl_client_type' => 'نوع العميل',
  'tbl_client_cp_contact_name' => 'إسم',
  'tbl_client_cp_number' => 'عدد',
  'tbl_client_cp_position' => 'موضع',
  /****** ِِCourt Table */
  'tbl_court_number' => 'عدد',
  'tbl_libelle_court' => 'التسمية',

  /*****Session Table */
  'tbl_session_libelle' => 'إسم الجلسة',
  'tbl_session_date' => 'تاريخ الجلسة',
  'tbl_session_description' => 'تفاصيل الجلسة',
  'session_docs' => 'مرفقات الجلسة',
  'case_session_details' => 'تفاصيل الجلسة',
  'session_enaba' => 'سند الإنابة',
  'tbl_session_status_id' => 'حالة الجلسة',
  'tbl_session_seond_date' => 'تاريخ الجلسة القادمة',
  'tbl_session_postpone_reason' => 'أسباب التأجيل',

  /*****ِConsultation Table */
  'tbl_consultation_date' => 'تاريخ الإستشارة',
  'tbl_consultation_description' => 'أسباب الزيارة',
  'tbl_consultation_Offer_Amount' => 'مبلغ الإستشارة',
  'tbl_consultation_lawyer' => 'المحامي المختص',

  /*****Expense Table */
  'tbl_expense_date' => 'التاريخ',
  'tbl_expense_description' => 'تفاصيل/ملاحظات',
  'tbl_expense_amount' => 'مبلغ المصروفات',
  'tbl_expense_payement' => 'المصروفات المنجزة',
  'tbl_expense_remain' => 'المتبقي',
  'tbl_expense_libelle' => 'تسمية المصروفات',
  'tbl_expense_types_id' => 'أقسام المصروفات',


  /*****ِClientOffer Table */
  'tbl_offer_date' => 'تاريخ العرض',
  'tbl_send_date' => 'تاريخ الإرسال',
  'tbl_offer_description' => 'تفاصيل العرض',
  'tbl_offer_Amount' => 'قيمة الأتعاب',
  'tbl_offer_from' => 'نوع العرض',

  /*****ِClientOffer Table */
  'tbl_file_libelle' => 'إسم الملف/الصورة',
  'tbl_file_file' => 'رفع الملف/الصورة',
  'tbl_file_view' => 'عرض الملف/الصورة',

  /*****LegalLink Table */
  'tbl_legal_libelle' => 'التسمية',
  'tbl_legal_description' => 'التفاصيل',
  'tbl_legal_url' => 'الرابط',

  /*****Poa Table */
  'tbl_poa_code' => 'كود الوكالة',
  'tbl_poa_title' => 'المسمى على التوكيل',
  'tbl_poa_type' => 'نوع الوكالة',
  'tbl_poa_expiry_date' => 'تاريخ الإنتهاء',
  'tbl_poa_file_name' => 'المستند المرتبط',
  'tbl_poa_file_path' => 'رفع المستند المرتبط',

  /*****Event Table */
  'tbl_event_title' => 'عنوان الحدث/الموعد',
  'tbl_event_description' => 'التفاصيل',
  'tbl_event_status' => 'الحالة',
  'tbl_event_start_at' => 'بداية من',
  'tbl_event_end_at' => 'إلى غاية',
  'tbl_event_color' => 'لون الخلفية',
  'tbl_event_textColor' => 'لون الخط',
  'user_id' => 'الموظف/المحامي/المستعمل',

  // Common
  'tbl_active' => 'مفعل',
  'tbl_created_at' => 'تاريخ الإضافة',
  'tbl_updated_at' => 'تاريخ التحيين',
  'tbl_suspended' => 'غير مفعل',
  'cases_numbers' => 'عدد القضايا',
  'tbl_libelle_type' => 'اسم النوع',
  //tbl soumissionnaires & etablissements
  'tbl_libelle' => 'التسمية',
  'tbl_contact' => 'جهة الإتصال',
  'tbl_responsable' => 'المسؤول',
  'tbl_adresse' => 'العنوان',
  'tbl_code_postal' => 'الترقيم البريدي ',
  'tbl_ville' => 'المدينة',
  'tbl_gouvernorat' => 'المحافظة',
  'tbl_tel_fax' => 'الفاكس',
  'tbl_email' => 'العنوان الإلكتروني',
  'tbl_matricule_fiscale' => 'المعرف الجبائي',
  'tbl_entete' => 'رأس الصفحة ',
  'tbl_code_pa' => 'ترقيم مشاريع الشراءات',
  'tbl_code_consult' => 'ترقيم الإستشارات ',
  'tbl_code_ao' => 'ترقيم طلبات العروض',
  'tbl_reglagesGeneraux' => 'إعدادات عامة',
  'tbl_parametreAvertissement' => 'إعدادات التنبيهات',
  'tbl_ajouter_annee' => 'الترقيم يضاف اليه السنة المالية',
  'tbl_reset_code' => 'الترقيم يعاد الى الواحد في كل سنة مالية',
  'tbl_validation_besoins' => 'تفعيل تنبيه عند المصادقة على الحاجيات',
  'tbl_notif_pa' => 'تفعيل تنبيه لإعداد ملف شراء',
  'tbl_notif_duree_pa' => 'تنبيه لإعداد ملف شراء قبل',
  'tbl_notif_publication_achat' => 'تفعيل تنبيه لنشر الإعلان عن صفقة ',
  'tbl_notif_duree_publication' => 'تنبيه لنشر الإعلان عن صفقة قبل',
  'tbl_notif_reglagesGeneraux_op' => 'تفعيل تنبيه لجلسة فتح الظروف',
  'tbl_notif_duree_reglagesGeneraux_op' => 'تنبيه لجلسة فتح الظروف قبل ',
  'tbl_notif_date_caution_final' => 'تنبيه بتاريخ تقديم الضمان النهائي',
  'tbl_notif_duree_caution_final' => 'تنبيه بتاريخ تقديم الضمان النهائي قبل',
  'tbl_notif_delais_rp' => 'تفعيل تنبيه بحلول آجال الإستلام الوقتي ',
  'tbl_notif_duree_rp' => 'تنبيه بحلول آجال الإستلام الوقتي قبل ',

  'tbl_libelle_status' => 'اسم الحالة',
  'tbl_email' => 'البريد الإلكتروني',
  'tbl_email_abr' => 'إيميل',
  'appointement' => 'المواعيد',
  'case_session' => 'جلسات القضية',
  'case_parties' => 'أطراف القضية',
  'case_docs' => 'مرفقات القضية',
  'case_infos' => 'بيانات القضية',
  'case_parties_other' => 'بيانات الأطراف الأخرى',
  'client_company' => 'شركة',
  'client_person' => 'شخص طبيعي',
  'client_other_partie' => 'إلى جانب الخصم',
  'client_partie' => 'إلى جانب العميل',
  'choose' => 'إختر من القائمة',

  'tbl_poa_type_1' => 'توكيل خاص',
  'tbl_poa_type_0' => 'توكيل عام',

  'client_person_0' => 'شخص طبيعي',
  'client_company_1' => 'شركة',
  'cp_details' => 'بيانات الشركة',
  'party_name' => 'إسم الطرف',
  'type_party' => 'نوع الطرف',
  'with_client_partie' => ' إلى جانب العميل',
  'with_other_partie' => 'إلى جانب الخصم',
  'tbl_case_amount_d' => ' ...',
  'judge_name' => 'إسم القاضي',
  'court_type' => 'محمكة',
  'circle_type' => 'دائرة محكمة',
  'tbl_court_type' => 'النوع',
  'all' => 'الكل',
  'global_settings' => 'إعدادات عامة',
  'event_settings' => 'إعدادات المواعيد',
  'email_settings' => 'إعدادات البريد الإلكتروني',
  //event settings (calendar default view)
  'calendar_month' => 'شهر',
  'calendar_agendaWeek' => 'أسبوع',
  'calendar_listMonth' => 'أجندة',
  'calendar_agendaDay' => 'يوم',

  'monday' => 'الاثنين',
  'tuesday' => 'الثلاثاء',
  'wednesday' => 'الاربعاء',
  'thursday' => 'الخميس',
  'friday' => 'الجمعة',
  'saturday' => 'السبت',
  'sunday' => 'الاحد',

  'checkAll' => 'إختيار الكل',
  'date_deb' => 'تاريخ البداية',
  'date_fin' => 'تاريخ النهاية',

  'customer_payements' => 'التقرير المالي',

  /***** ClientPayement Table */
  'tbl_client_payement_libelle' => 'اسم الدفعة',
  'tbl_client_payement_amount' => 'المبلغ المدفوع',
  'tbl_client_payement_type_id' => 'طريقة الدفع',
  'tbl_client_payement_date' => 'تاريخ الدفع',

  /*****ExpensePayement Table */
  'tbl_expense_payement_date' => 'تاريخ الدفع',
  'tbl_expense_payement_libelle' => 'اسم الدفعة',
  'tbl_expense_payement_amount' => 'المبلغ المدفوع',
  'tbl_expense_payement_type_id' => 'طريقة الدفع',

  /*****Income Table */
  'tbl_income_date' => 'تاريخ المداخيل',
  'tbl_income_amount' => 'مبلغ المداخيل',
  'tbl_income_payement' => 'المدفوعات المنجزة',
  'tbl_income_remain' => 'المتبقي',
  'tbl_income_from' => 'مصدر المداخيل',

  /*****ClientPayement Table */
  'tbl_client_payement_date' => 'تاريخ الدفع',
  'tbl_client_payement_libelle' => 'اسم الدفعة',
  'tbl_client_payement_amount' => 'المبلغ المدفوع',
  'tbl_client_payement_type_id' => 'طريقة الدفع',

  /*****ReplacementDoc Table */
  'tbl_replace_lawyer_id' => 'المحامي المنوب',
  'tbl_replacement_floor' => 'الطابق',
  'tbl_replacement_hall' => 'القاعة',
  'tbl_replacement_hour' => 'الساعة',
  'tbl_replacement_description' => 'الطلبات',

  'cases' => 'مصدر المدفوعات: قضية',
  'calendar_default_view' => 'العرض الافتراضي الرئيسي للمواعيد',
  'days_off' => 'أيام الراحة الأسبوعية',
  'calendar_min_time' => 'توقيت بداية الدوام',
  'calendar_max_time' => 'توقيت نهاية الدوام',
  'replacementDoc' => 'سند إنابة',


];
