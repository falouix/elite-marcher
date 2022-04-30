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
    'lbl_role' => 'ٌRole',
    'lbl_libelle_role' => 'Role Name',
    'lbl_libelle_role' => 'Role Name (Arabic)',
    // Swal Delete
    'swal_delete_title' => 'Are you sure?',
    'swal_delete_text' => 'Once deleted, you will not be able to recover this Record!',
    'swal_confirm_btn' => 'Yes, delete!',
    'swal_cancel_btn' => 'Cancel',
    'swal_warning_title'=>'Ouups!',
    'swal_delete_users_warning_text'=>'Please select at least one user to delete.',
    'swal_delete_clients_warning_text'=>'Please select at least one client to delete.',
    'swal_delete_cases_warning_text'=>'Please select at least one case to delete.',
    'swal_create_account' => 'Create Customer Account',
    'swal_create_account_info_text' => 'Are you sure, you wont to create a Customer Account?',
    'swal_error_title' =>'Error',
    'swal_error_event_star_end_date' =>'Please check start & end date',
    'swal_error_colors' =>'Text coloer & Background color must be different!',

    // Pnotify
    'pnotify_title' => 'Multiple Delete In Progress',

    // tables
    /***** User Table */
    'tbl_qin' => 'Qatar ID',
    'tbl_name' => 'Full Name',
    'tbl_email' => 'Email',
    'tbl_password' => 'Password',
    'tbl_confirm_password' => 'Confirm password',
    'tbl_passport' => 'Passport',
    'tbl_description' => 'Notes',
    'tbl_phone' => 'Phone',
    'tbl_adress' => 'Adress',
    'tbl_start_date' => 'Start date',
    'tbl_end_date' => 'End date',
    'tbl_role' => 'Role(s)',
    'tbl_action' => 'Action',

    /***** Case Table */
    'tbl_case_num' => 'Code Number',
    'tbl_case_code' => 'Case code',
    'tbl_case_date' => 'Case date',
    'tbl_cas_type_id' => 'Case type',
    'tbl_description' => 'Description',
    'tbl_court_id' => 'ِCourt',
    'tbl_court_num' => 'Court circle',
    'tbl_lawyer_id' => 'Lawyer on the case',
    'tbl_case_status_id' => 'Case Status',
    'tbl_case_stage_id' => 'Case Stage',
    'tbl_case_amount' => 'Case Amount',

     /*****Client Table */
     'tbl_client_code'=>'ِClient Code',
     'tbl_client_nationality'=>'Nationality',
     'tbl_client_cp_name'=>'Company Name [Arabic]',
     'tbl_client_cp_name_en'=>'Company Name [English]',
     'tbl_client_cp_registration'=>'Company Registration Number',
     'tbl_client_cp_phone_num'=>'Company Phone Number',
     'tbl_client_cp_adress'=>'Company Adress',
     'tbl_client_adress'=>'Company Adress',
     'tbl_client_name'=>'ِClient Name [Arabic]',
     'tbl_client_name_en'=>'ِClient Name [English]',
     'tbl_client_phone'=>'Phone',
     'tbl_client_type'=>'Client type',
     'tbl_client_cp_contact_name'=>'Name',
     'tbl_client_cp_number'=>'Number',
     'tbl_client_cp_position'=>'Position',

      /*****Session Table */
      'tbl_session_libelle'=>'Label',
      'tbl_session_date'=>'Date',
      'tbl_session_description'=>'Details',
    'session_docs' => 'Session documents',
    'case_session_details' => 'Session details',
    'session_enaba' => 'Session enaba',
    'tbl_session_status_id' => 'Session details',
    'tbl_session_seond_date' => 'Session second date',
    'tbl_session_postpone_reason' => 'Session postpone reason',

      /*****ِConsultation Table */
      'tbl_consultation_date'=>'ِDate',
      'tbl_consultation_description'=>'Reason for visit',
      'tbl_consultation_Offer_Amount'=>'Amount',
      'tbl_consultation_lawyer' => 'Attending Lawyer',

    /*****Expense Table */
    'tbl_expense_date' => 'Expense Date',
    'tbl_expense_description' => 'Description',
    'tbl_expense_amount' => 'Expense Amount',
    'tbl_expense_libelle' => 'Expense Label',
    'tbl_expense_types_id' => 'Expense Type',
    'tbl_expense_remain' => 'Remain',

       /*****ِClientOffer Table */
    'tbl_offer_date' => 'Offer Date',
    'tbl_send_date' => 'Send Date',
    'tbl_offer_description' => 'Offer Details',
    'tbl_offer_Amount' => 'Offer Amount',
    'tbl_offer_from' => 'Offer Type',

    /*****ِClientOffer Table */
    'tbl_file_libelle' => 'File name',
    'tbl_file_file' => 'Attach file',

    /*****LegalLink Table */
    'tbl_legal_libelle' => 'Label',
    'tbl_legal_description' => 'Description',
    'tbl_legal_url' => 'The Link',


    /*****Poa Table */
    'tbl_poa_code' => 'POA Code',
    'tbl_poa_title' => 'Attach Client',
    'tbl_poa_type' => 'POA Type',
    'tbl_poa_expiry_date' => 'Expiry Date',
    'tbl_poa_file_name' => 'Document Name',
    'tbl_poa_file_path' => 'Attach Document',

    /*****Event Table */
    'tbl_event_title' => 'Title',
    'tbl_event_description' => 'Details',
    'tbl_event_status' => 'Status',
    'tbl_event_start_at' => 'Start at',
    'tbl_event_end_at' => 'End at',
    'tbl_event_color' => 'Bakc-ground color',
    'tbl_event_textColor' => 'Text color',
    'user_id' => 'User',



    // Common
    'tbl_active' => 'Active',
    'tbl_suspended' => 'Suspended',
    'tbl_created_at' => 'Created At',
    'tbl_updated_at' => 'Updated At',
    'cases_numbers' => 'Num. of cases',
    'tbl_libelle_type'=>'Label',
    'tbl_email_abr' => 'Email',
    'tbl_libelle_status'=>'status label',
    'appointement'=>'Appointment(s)',
    'case_session' => 'Case Session(s)',
    'case_parties' => 'Case Partie(s)',
    'case_docs' => 'Files & docuements',
    'case_infos' => 'Case informations',
    'case_parties_other' => 'ِCase Parties',
    'client_company' => 'Company',
    'client_person' => 'Person',
    'client_other_partie'=>'Ohter party',
    'client_partie'=>'Client party',
    'tbl_libelle' => 'Label',
    'choose' => 'Choose from list',
    'tbl_poa_type_1' => 'Limited PoA',
    'tbl_poa_type_0' => 'Genral PoA',

    'client_person_0' => 'Company',
    'client_company_1' => 'Person',
    'cp_details' => 'ِCompany details',
    'party_name' => 'Party Name',
    'type_party' => 'Party Type',
    'with_client_partie' => 'With Client',
    'with_other_partie' => 'Other Party',
    'judge_name' => 'Judge Name',
    'court_type' => 'Court',
    'circle_type' => 'Circle',
    'all' => 'All',

    //event settings (calendar default view)
    'calendar_month'=>'Month',
    'calendar_agendaWeek'=>'Week',
    'calendar_listMonth'=>'List Month',
    'calendar_agendaDay'=>'Day',

    'monday'=>'Monday',
    'tuesday'=>'Tuesday',
    'wednesday'=>'Wednesday',
    'thursday'=>'Thursday',
    'friday'=>'Friday',
    'saturday'=>'Saturday',
    'sunday'=>'Sunday',

    'checkAll'=>'Check All',

    'date_deb'=>'Start date',
    'date_fin'=>'End date',

    'customer_payements' => 'Payment Report',

    /***** ClientPayement Table */
    'tbl_client_payement_libelle' => 'Payment Label',
    'tbl_client_payement_amount' => 'Payment Amount',
    'tbl_client_payement_type_id' => 'Payment Type',
    'tbl_client_payement_date' => 'Payment Date',

    /*****ExpensePayement Table */
    'tbl_expense_payement_date' => 'Payment Date',
    'tbl_expense_payement_libelle' => 'Payment Label',
    'tbl_expense_payement_amount' => 'Payment Amount',
    'tbl_expense_payement_type_id' => 'Payment Method',

      /*****Income Table */
      'tbl_income_date' => 'Date',
      'tbl_income_amount' => 'Income Amount',
      'tbl_income_payement' => 'Payment Amount',
      'tbl_income_remain' => 'Remain',
      'tbl_income_from' => 'Incomes From',

       /*****ClientPayement Table */
    'tbl_client_payement_date' => 'Payment Date',
    'tbl_client_payement_libelle' => 'Payment Label',
    'tbl_client_payement_amount' => 'Payment Amount',
    'tbl_client_payement_type_id' => 'Payment Method',

     /*****ReplacementDoc Table */
     'tbl_replace_lawyer_id' => 'المحامي المنوب',
     'tbl_replacement_floor' => 'الطابق',
     'tbl_replacement_hall' => 'القاعة',
     'tbl_replacement_hour' => 'الساعة',
     'tbl_replacement_description' => 'الطلبات',


    'cases'=>'Incomes from : Case',
    'calendar_default_view'=>'Calendar default view',
    'days_off'=>'Days off',
    'calendar_min_time'=>'Day Start time',
    'calendar_max_time'=>'Day End time',
    'replacementDoc'=>'Replacement document',



];
