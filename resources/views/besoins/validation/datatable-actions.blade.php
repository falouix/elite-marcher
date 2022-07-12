{{--
    @can('user-edit')
@if($docs_id)
<a href="{{route('file.upload.get',['id'=>$docs_id,'param'=>'besoin_documents']) }}" class="btn btn-icon btn-rounded btn-primary"
    title="{{ __('inputs.btn_view_file') }}" target="_blank" >
        <i class="feather icon-eye"></i>
    </a>
@endif
@endcan
--}}
@can('user-edit')

<a href="{{ route('besoins-validation.edit', $id) }}" class="btn btn-icon btn-rounded btn-primary"
        title="المصادقة على الحاجيات">
        <i class="feather icon-edit-1"></i>
    </a>
@endcan
@can('user-edit')

<button type="button"  class="btn btn-icon btn-rounded btn-danger"
        title="المصادقة النهائية على الحاجيات" onclick="validerBesoin({{ $id }})">
        <i class="feather icon-check-circle"></i>
</button>
@endcan
