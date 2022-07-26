
@can('besoin-edit')
<a href="#" class="btn btn-icon btn-rounded btn-primary" title="{{ __('inputs.btn_view') }}">
    <i class="feather icon-eye"></i>
</a>
@endcan
@can('besoin-edit')
@if($transferer == false)
@can('besoin-edit')
<a href="{{ route('projets.edit', $id) }}" class="btn btn-icon btn-rounded btn-success"
        title="{{ __('inputs.btn_edit') }}">
        <i class="feather icon-edit"></i>
    </a>
@endcan
@can('besoin-delete')
    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"></i>
    </button>
@endcan
<button type="button" data-id='{{ $id }}' class="btn btn-info feather icon-plus-circle"
title="إعداد ملف شراء" id="tbl_btn_transferDA"
onclick="tranfererDA({{ $id }}, '{{ $nature_passation }}')">ملف شراء</button>
@endif
@endcan

