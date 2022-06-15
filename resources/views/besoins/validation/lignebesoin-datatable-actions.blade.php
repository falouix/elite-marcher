@if($valider == false)

@can('user-delete')
    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_edit') }}" onclick="editLigneBesoin({{ $id }})">
        <i class="feather icon-edit"></i>
    </button>
@endcan

@endif
