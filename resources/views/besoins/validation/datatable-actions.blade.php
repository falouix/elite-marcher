@can('besoin-validate')
<a href="{{ route('besoins-validation.edit', $id) }}" class="btn btn-icon btn-rounded btn-primary"
        title="المصادقة على الحاجيات">
        <i class="feather icon-edit-1"></i>
    </a>
<button type="button"  class="btn btn-icon btn-rounded btn-danger"
        title="المصادقة النهائية على الحاجيات" onclick="validerBesoin({{ $id }})">
        <i class="feather icon-check-circle"></i>
</button>
@endcan
