@can('besoin-edit')

<a href="{{ route('dossiers.show', ['id'=> $id]) }}" class="btn btn-icon btn-rounded btn-primary" title="{{ __('inputs.btn_view') }}">
    <i class="feather icon-eye"></i>
</a>
@endcan
