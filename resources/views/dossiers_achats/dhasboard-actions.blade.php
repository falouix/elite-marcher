@switch ($type_dossier)
    @case('CONSULTATION')
        @can('besoin-edit')
            <a href="{{ route('consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

    @case('AOS')
        @can('besoin-edit')
            <a href="{{ route('consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

    @case('AON')
        @can('besoin-edit')
            <a href="{{ route('AON.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

    @case('AOGREGRE')
        @can('besoin-edit')
            <a href="{{ route('consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
        @endcan
    @break

@endswitch
