@can('case-type-delete')
    <a href="{{route('file.upload.get',['id'=>$id,'param'=>'session_docuements']) }}" class="btn btn-icon btn-rounded btn-primary"
    title="{{ __('inputs.btn_view') }}" target="_blank" >
        <i class="feather icon-eye"></i>
    </a>
@endcan
@can('case-type-delete')
<button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
    title="{{ __('inputs.btn_delete') }}" onclick="deleteFile({{ $id }})">
    <i class="feather icon-trash-2"></i>
</button>
@endcan