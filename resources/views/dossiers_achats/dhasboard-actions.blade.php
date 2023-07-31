@switch ($type_dossier)
    @case('CONSULTATION')
        @can('consultations-view')
            <a href="{{ route('consultations.show', ['consultation' => encrypt($id)]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

    @case('AOS')
        @can('AOS-view')
            <a href="{{ route('consultations.show', ['consultation' => encrypt($id)]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

    @case('AON')
        @can('AON-view')
            <a href="{{ route('AON.show', ['consultation' => encrypt($id)]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

    @case('AOGREGRE-view')
        @can('besoin-edit')
            <a href="{{ route('consultations.show', ['consultation' => encrypt($id)]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

@endswitch
