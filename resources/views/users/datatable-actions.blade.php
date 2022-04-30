
@can('user-edit')
    <a href="{{ route('users.edit', $id) }}" class="btn btn-icon btn-rounded btn-success"
        title="{{ __('inputs.btn_edit') }}">
        <i class="feather icon-edit"></i>
    </a>
@endcan
@can('user-delete')
    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"></i>
    </button>
@endcan
