@can('case-type-edit')
    <a href="#" class="btn btn-icon btn-rounded btn-success" data-id="{{  $id }}"
        title="{{ __('inputs.btn_edit') }}" onclick="editChapitre({{ $id }})">
        <i class="feather icon-edit"></i>
    </a>
@endcan
@can('case-type-delete')
    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"></i>
    </button>
@endcan
