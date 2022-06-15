@can('user-edit')
@if($docs_id)
<a href="{{route('file.upload.get',['id'=>$docs_id,'param'=>'besoin_documents']) }}" class="btn btn-icon btn-rounded btn-primary"
    title="{{ __('inputs.btn_view_file') }}" target="_blank" >
        <i class="feather icon-eye"></i>
    </a>
@endif
@endcan
@can('user-edit')
<a href="{{ route('besoins.edit', $id) }}" class="btn btn-icon btn-rounded btn-success"
        title="{{ __('inputs.btn_edit') }}">
        <i class="feather icon-edit"></i>
    </a>
@endcan
@if($valider == false)
@can('user-delete')
    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"></i>
    </button>
@endcan
@endif
