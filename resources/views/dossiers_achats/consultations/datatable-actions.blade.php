
@can('consultations-view')
<a href="{{ route('consultations.show', ['consultation'=> encrypt($id)]) }}" class="btn btn-icon btn-rounded btn-primary" title="{{ __('inputs.btn_view') }}">
    <i class="feather icon-eye"></i>
</a>
@endcan

@can('consultations-edit')
<a href="{{ route('consultations.edit', encrypt($id)) }}" class="btn btn-icon btn-rounded btn-success"
        title="{{ __('inputs.btn_edit') }}">
        <i class="feather icon-edit"></i>
    </a>
@endcan

@can('consultations-delete')
    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"></i>
    </button>
@endcan

