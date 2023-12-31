@can('besoin-view')

<a href="{{ route('besoins.show', $id) }}" class="btn btn-icon btn-rounded btn-primary"
        title="عرض التفاصيل">
        <i class="feather icon-eye"></i>
    </a>
@endcan

@if($valider == false)
@can('besoin-edit')
<a href="{{ route('besoins.edit', $id) }}" class="btn btn-icon btn-rounded btn-success"
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
@endif
