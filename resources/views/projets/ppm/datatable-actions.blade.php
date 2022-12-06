@can('projet-achat-view')
    <a href="{{ route('ppm.show', ['ppm' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
        title="{{ __('inputs.btn_view') }}">
        <i class="feather icon-eye"></i>
    </a>
@endcan

@if ($transferer == false)
    @can('projet-achat-edit')
        <a href="{{ route('ppm.edit', $id) }}" class="btn btn-icon btn-rounded btn-success"
            title="{{ __('inputs.btn_edit') }}">
            <i class="feather icon-edit"></i>
        </a>
    @endcan
@endif
