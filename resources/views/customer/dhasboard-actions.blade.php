@switch ($type_dossier)
    @case('CONSULTATION')
            <a href="{{ route('customer-consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
    @break
    @case('AOS')
            <a href="{{ route('customer-consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
    @break
    @case('AON')
            <a href="{{ route('customer-consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
    @break
    @case('AOGREGRE-view')
            <a href="{{ route('customer-consultations.show', ['consultation' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
                title="{{ __('inputs.btn_view') }}">
                <i class="feather icon-eye"></i>
            </a>
    @break
@endswitch
