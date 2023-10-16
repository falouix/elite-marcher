@php
    if ($locale == 'ar') {
        $lang = asset('/plugins/i18n/Arabic.json');
        $rtl = 'rtl';
    } else {
        $lang = '';
        $rtl = 'ltr';
    }
    $tbl_action = __('labels.tbl_action');
@endphp

@extends('layouts.app')
@section('head-script')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/data-tables/css/select.dataTables.min.css') }}">
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
@endsection


@section('breadcrumb')
    @include('layouts.partials.breadcrumb', [
        'bread_title' => 'مشروع شراء',
        'bread_subtitle' => 'إضافة مشروع شراء',
    ])
@endsection

@section('content')
    <!-- Column Selector table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>إضافة مشروع شراء</h5>
                <div class="card-header-right">
                    <a href="{{ route('projets.index') }}" class="btn btn-secondary">
                        العودة لقائمة مشاريع الشراءات
                        <i class="feather icon-corner-down-left"></i>
                    </a>

                </div>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>{{ __('validation.v_title') }}</strong><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                @endif
                <!-- [ Form Validation ] start -->



                {{-- Case Other Parties --}}
                {!! Form::open(['route' => 'projets.store', 'method' => 'POST', 'id' => 'validation-projet_form']) !!}
                <input type="text" name="lignesprjt" id="lignesprjt" hidden>
                <input type="text" name="lbsoins_ids" id="lbsoins_ids" hidden>
                <div class="row">
                    <div class="col-md-3" hidden>
                        <div class="form-group">
                            <label for="annee_gestion"> السنة المالية </label>
                            <input type="number" class="form-control" id='annee_gestion' name="annee_gestion"
                                placeholder="أدخل السنة المالية" value='{{ strftime('%Y') }}' readonly>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طبيعة الطلب</label>
                            <select class="form-control" id="gtype_demande" name="type_demande">
                                <option value="1">مواد وخدمات</option>
                                <option value="2">أشغال</option>
                                <option value="3">دراسات</option>
                            </select>
                            <label id="type_demande-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">طريقة الإبرام</label>
                            <select class="form-control" id="nature_passation" name="nature_passation">
                                <option value="all">اختر طريقة الإبرام</option>
                                <option value="CONSULTATION">استشارة عادية</option>
                                <option value="AOS">صفقة إجراءات مبسطة </option>
                                <option value="AON">صفقة إجراءات عادية</option>
                                <option value="AOGREGRE">صفقة بالتفاوض المباشر</option>
                            </select>
                            <label id="nature_passation-error"
                                class="error jquery-validation-error small form-text invalid-feedback"
                                for="libelle"></label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">الموضوع</label>
                            <input type="text" class="form-control" name="objet" id="objet">
                            <label id="objet-error" class="error jquery-validation-error small form-text invalid-feedback"
                                for="objet"></label>
                        </div>
                    </div>
                </div>
                <button type="submit" id="btn_submit" class="btn btn-primary" style="float: right;" hidden>
                </button>
                {!! Form::close() !!}
                {{-- Contact from company  start --}}
                @can('besoin-exception')
                    {{-- Contact from company  start --}}
                    <form id="cp_form" action="#">
                        <input type="hidden" name="lignebesoin_id" id="lignebesoin_id" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h3 class="form-label"> إضافة إستثنائية للحاجيات</h3>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">طبيعة الطلب</label>
                                    <select class="form-control" id="type_demande">
                                        <option value="1">مواد وخدمات</option>
                                        <option value="2">أشغال</option>
                                        <option value="3">دراسات</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">نوع الطلب</label>
                                    <select class="form-control " id="natures_demande" name="natures_demande">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">المادة (التسمية)</label>
                                    <select class="form-control " id="articles_id" name="articles_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">الكمية المطلوية</label>
                                    <input type="number" class="form-control" name="qte_demande" placeholder="الكمية..."
                                        value="{{ old('qte_demande') }}" onchange="calculTotal()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">الكلفة التقديرية للوحدة(بالدينار)</label>
                                    <input type="number" class="form-control" name="cout_unite_ttc"
                                        placeholder="كلفة الوحدة..." value="{{ old('cout_unite_ttc') }}"
                                        onchange="calculTotal()">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">الكلفة التقديرية الجملية(بالدينار)</label>
                                    <input type="number" class="form-control" name="cout_total_ttc"
                                        placeholder="الكلفة التقديرية الجملية(بالدينار)..." value="0" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> إسم الملف المرفق (الخصائص الفنية) </label>
                                <input type="text" class="form-control" name="file_name" id="file_name"
                                    placeholder="إسم الملف المرفق" value="">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">الملف/الوثيقة</label>
                                <input type="file" id="file" name="file" class="form-control form-control-file"
                                    id="file">
                                <label id="file-error" class="error jquery-validation-error small form-text invalid-feedback"
                                    for="file"></label>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"> الملاحظات </label>
                                <input type="text" class="form-control" name="description" id="description"
                                    placeholder="الملاحظات" value="">

                            </div>

                            <div class="col-md-12">

                                <a href="javascript:void(0);" class="btn btn-rounded btn-info" id='add'
                                    for-table='#table-cp'>
                                    <i class="feather icon-plus"></i>
                                    <span class="spinner-border spinner-border-sm" role="status" hidden></span>
                                    <span id="btn_add_poa_title">إضافة إلى الجدول</span>

                                </a>



                            </div>
                        </div>
                    </form>
                    {{-- Contact from company  end --}}
                @endcan
                {{-- Contact from company  end --}}


                <div class="card-body">

                    <h4>إختيار محتوى المشروع</h4>

                    <div class="dt-responsive table-responsive">

                        <h6 style="color: red; text-align: left;">الكلفة الجمليةالتقديرية للحاجيات المختارة : <span
                                id="coutTotal">
                            </span></h6>

                        <table id="table-cp" class="table table-striped table-bordered nowrap">
                            <thead>
                                <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                        class="select-checkbox not-export-col" /> </th>
                                <th class="not-export-col">id</th>
                                <th>المادة</th>
                                <th>طبيعة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>الكمية المطلوبة</th>
                                <th>الكمية المصادقة</th>
                                <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                                <th>الكلفة التقديرية الجملية(بالدينار)</th>
                                <th class="not-export-col">ids</th>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th class="not-export-col" style="width: 30px"><input type="checkbox"
                                            class="select-checkbox not-export-col" /> </th>
                                    <th class="not-export-col">id</th>
                                    <th>المادة</th>
                                    <th>طبيعة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>الكمية المطلوبة</th>
                                    <th>الكمية المصادقة</th>
                                    <th>الكلفة التقديرية للوحدة(بالدينار)</th>
                                    <th>الكلفة التقديرية الجملية(بالدينار)</th>
                                    <th class="not-export-col" style="display: none;">ids</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <button type="button" id="btn_create" class="btn btn-primary" style="float: right;">
                        <i class="feather icon-client-plus"></i>
                        {{ __('inputs.btn_create') }}
                    </button>
                    <a href="{{ route('projets.index') }}" class="btn btn-danger" style="float: left;">
                        <i class="feather icon-minus-circle"></i>
                        {{ __('inputs.btn_cancel') }}
                    </a>
                </div>
                <!-- [ Form Validation ] end -->

            </div>
        </div>
    </div>
@endsection
@section('srcipt-js')
    <!-- datatable Js -->
    <script src="{{ asset('/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/dataTables.select.min.js') }}"></script>
    <!-- jquery-validation Js -->
    <script src="{{ asset('/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!-- form-select-custom Js -->
    <script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('/plugins/data-tables/js/pdfmake.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/plugins/data-tables/js/sum().js') }}"></script>`

    <script>
        'use strict';
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // [ Initialize client-form validation ]
            $('#cp_form').validate({
                ignore: '.ignore, .select2-input',
                focusInvalid: false,
                rules: {
                    'libelle': {
                        required: true,
                    },
                    'qte_demande': {
                        required: true,
                    },
                    'cout_unite_ttc': {
                        required: true,
                    },
                },
                // Errors //

                errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents('.form-group');

                    // Do not duplicate errors
                    if ($parent.find('.jquery-validation-error').length) {
                        return;
                    }

                    $parent.append(
                        error.addClass(
                            'jquery-validation-error small form-text invalid-feedback')
                    );
                },
                highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents('.form-group');

                    $el.addClass('is-invalid');

                    // Select2 and Tagsinput
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr(
                            'data-role') === 'tagsinput') {
                        $el.parent().addClass('is-invalid');
                    }
                },
                unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass(
                        'is-invalid');
                }
            });

            var table = $('#table-cp').DataTable({
                dom: 'frltipB',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "{{ __('labels.all') }}"]
                ],
                buttons: [{
                        text: '{{ __('inputs.btn_copy') }}',
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_excel') }}',
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_pdf') }}',
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                    {
                        text: '{{ __('inputs.btn_print') }}',
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        }
                    },
                ],
                scrollY: true,
                scrollX: true,
                scrollCollapse: true,
                //paging: false,
                fixedColumns: {
                    leftColumns: 0,
                    rightColumns: 1
                },
                initComplete: function() {
                    // Apply the search
                    this.api().columns().every(function() {
                        var that = this;
                        $('input', this.footer()).on('keyup change clear',
                            function() {
                                if (that.search() !== this.value) {
                                    that
                                        .search(this.value)
                                        .draw();
                                }
                            });
                    });
                },
                processing: true,
                //serverSide: true,
                serverMethod: 'POST',
                ajax: {
                    url: "{{ route('pais.datatable') }}",
                    data: function(data) {
                        data.annee_gestion = $('#annee_gestion').val()
                        data.services_id = 'all'
                        data.type_demande = $('#gtype_demande').val()
                        data.nature_demande = 'all'
                        data.mode = 'projets'
                    },
                },
                language: {
                    url: "{{ $lang }}"
                },
                columns: [{
                        data: "select",
                        className: "select-checkbox"
                    },
                    {
                        data: "id",
                        className: "id",
                    },
                    {
                        data: "libelle",
                        className: "libelle"
                    },
                    {
                        data: "type_demande",
                        className: "type_demande"
                    },
                    {
                        data: "nature_demandes_id",
                        className: "nature_demandes_id"
                    },
                    {
                        data: "sumqte_demande",
                        className: "sumqte_demande"
                    },
                    {
                        data: "sumqte_valide",
                        className: "sumqte_valide"
                    },
                    {
                        data: "cout_unite_ttc",
                        className: "cout_unite_ttc"
                    },
                    {
                        data: "sumcout_total_ttc",
                        className: "sumcout_total_ttc"
                    },
                    {
                        data: 'ids',
                        className: 'ids',
                        visible: 'false'
                    },
                ],
                columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    },
                    {
                        visible: false,
                        targets: [1, ç]
                    }
                ],
                /*
                drawCallback: function() {
                        var api = this.api();
                        $('#coutTotal').html(
                            api.column(7, {
                                page: 'current'
                            }).data().sum()
                        )
                    },
                */
                select: {
                    style: 'multi'
                },
            });
            $('.dataTables_length').addClass('bs-select');

            // Setup - add a text input to each footer cell

            addSearchFooterDataTable("#table-cp")

            table
                .on('select', function(e, dt, type, indexes) {
                    $('#coutTotal').html('...')
                    let items = table.rows('.selected').data()
                    let sum = 0
                    items.each((index) => {
                        sum += parseFloat(index.sumcout_total_ttc)
                        //  console.log(sum);
                    });
                    $('#coutTotal').html(sum)
                })
                .on('deselect', function(e, dt, type, indexes) {
                    $('#coutTotal').html('...')
                    let items = table.rows('.selected').data()
                    let sum = 0
                    items.each((index) => {
                        sum += parseFloat(index.sumcout_total_ttc)
                        //  console.log(sum);
                    });
                    $('#coutTotal').html(sum)

                });


            // add Besoin - Exception
            $("#natures_demande").select2({
                dir: "{{ $rtl }}",
                // minimumInputLength: 3, // only start searching when the user has input 3 or more characters
                //placeholder: "{{ __('labels.choose') }} ",
                ajax: {
                    url: "{{ route('natures-demande.select') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',
                    data: {
                        type: $('#type_demande').val()
                    },
                },
                processResults: function(response) {
                    // alert(JSON.stringify(response))
                    return {
                        results: response
                    };
                },
                cache: true

            });
        });
        $('#type_demande').on('change', function(e) {
            var type = e.target.value;
            $.ajax({
                url: "{{ route('natures-demande.select') }}",
                type: "POST",

                data: {
                    type: type
                },
                success: function(data) {
                    $('#natures_demande').empty();
                    $('#natures_demande').append('<option value="NULL">إختر من القائمة</option>');
                    $.each(data.results, function(index, naturdemande) {
                        $('#natures_demande').append('<option value="' + naturdemande.id +
                            '">' +
                            naturdemande.text + '</option>');
                    })
                    $('#natures_demande').select2({
                        dir: "{{ $rtl }}",
                    });
                }
            })
        });
        $('#natures_demande').on('change', function(e) {
            var type = e.target.value;
            $.ajax({
                url: "{{ route('articles.select') }}",
                type: "POST",
                data: {
                    natures_demande_id: type
                },
                success: function(data) {
                    $('#articles_id').empty();
                    $('#articles_id').append('<option value="NULL">إختر من القائمة</option>');
                    $.each(data.results, function(index, article) {
                        $('#articles_id').append('<option value="' + article.id +
                            '">' +
                            article.text + '</option>');
                    })
                    $('#articles_id').select2({
                        dir: "{{ $rtl }}",
                    });
                }
            })
        });

        $('#add').click((e) => {
            e.preventDefault();
            //$('#libelle').removeClass('is-invalid')
            $('.spinner-border').removeAttr('hidden');
            var articleId = $('#articles_id').val()
            if (articleId === null || articleId == 'NULL' || articleId === undefined) {
                swal("{{ __('labels.swal_warning_title') }}", 'الرجاء تحديد المادة',
                    "warning");
                return false;
            }

            var formData = new FormData();
            formData.append('annee_gestion', $("#annee_gestion").val())
            formData.append('type_demande', $("#type_demande").val())
            formData.append('nature_demandes_id', $("#natures_demande").val())
            formData.append('articles_id', articleId)
            formData.append('description', $("input[name=description]").val())
            formData.append('file_name', $("input[name=file_name]").val())
            formData.append('qte_demande', $("input[name=qte_demande]").val())
            formData.append('cout_unite_ttc', $("input[name=cout_total_ttc]").val())
            formData.append('cout_unite_ttc', $("input[name=cout_unite_ttc]").val())
            formData.append('file', document.getElementById("file").files[0])
            //alert(file)
            var $type = 'POST'
            var $url = "{{ route('lignes_besoin.storeExeption') }}"

            $.ajax({
                url: $url,
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log(response)
                    $('.spinner-border').attr('hidden', 'hidden');
                    $('#table-cp').DataTable().ajax.reload();
                    $('#cp_form')[0].reset()
                    //$("#cp_form").get(0).reset()
                    $('#add').html("إضافة إلى الجدول")
                    PnotifyCustom(response)


                },
                error: function(response) {
                    $('.spinner-border').attr('hidden', 'hidden');
                    console.log(JSON.stringify(response.responseJSON));
                    $('.spinner-border').attr('hidden', 'hidden');
                    //  $('#file_name-error').html('')
                    $('#libelle-error').html('')
                    $('#file-error').html('')
                    // alert(JSON.stringify(response.responseJSON.message))
                    if (response.responseJSON.message.libelle != null) {
                        $('#libelle').addClass('is-invalid')
                        $('#libelle-error').text(response.responseJSON.message.poa_title);
                    }

                }
            }); // ajax end
        })

        // Search button click event (reload dtatable)
        $('#gtype_demande').on('change', (e) => {
            e.preventDefault();
            $('#table-cp').DataTable().ajax.reload();

        })

        //Submit form 'store'
        $('#btn_create').on("click", (e) => {
            e.preventDefault();

            $('#type_demande-error').hide()
            $('#nature_passation-error').hide()
            $('#type_demande').removeClass('is-invalid')
            $('#nature_passation').removeClass('is-invalid')

            var type_demande = $('#type_demande').val()
            var verif = 0
            if (type_demande === 'all') {
                verif = verif + 1
                $('#type_demande').addClass('is-invalid')
                $('#type_demande-error').text('الرجاء إختيار طبيعة الطلب');
                $('#type_demande-error').show()
            }
            var nature_passation = $('#nature_passation').val()
            if (nature_passation === 'all') {
                verif = verif + 1
                $('#nature_passation').addClass('is-invalid')
                $('#nature_passation-error').text('الرجاء إختيار  طريقة الإبرام');
                $('#nature_passation-error').show()
            }

            if (verif > 0) {
                return false
            }
            var {
                ids,
                lb_ids
            } = add_cp();
            //alert(JSON.stringify(lb_ids))
            $('#lignesprjt').val(JSON.stringify(ids))
            $('#lbsoins_ids').val(lb_ids)
            $("#btn_submit").click()
        })

        function add_cp() {
            var table = $('#table-cp').DataTable();
            var ids = $.map(table.rows('.selected').data(), function(item) {
                // console.log(item)
                return item.id
            });
            var lb_ids = $.map(table.rows('.selected').data(), function(item) {
                // console.log(item)
                return item.ids
            });
            return {
                ids,
                lb_ids
            };
        }
    </script>
@endsection
