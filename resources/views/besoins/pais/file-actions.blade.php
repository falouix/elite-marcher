@if($docs_id)
@can('besoin-file-edit')
<a href="{{route('file.upload.get',['id'=>$docs_id,'param'=>'besoin_documents']) }}" class="btn btn-icon btn-rounded btn-primary"
    title="{{ __('inputs.btn_view_file') }}" target="_blank" >
        <i class="feather icon-eye"></i>
    </a>
@endcan
@endif
