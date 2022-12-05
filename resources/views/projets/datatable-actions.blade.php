@can('projet-achat-view')
    <a href="{{ route('projets.show', ['projet' => $id]) }}" class="btn btn-icon btn-rounded btn-primary"
        title="{{ __('inputs.btn_view') }}">
        <i class="feather icon-eye"></i>
    </a>
@endcan

@if ($transferer == false)
    @can('projet-achat-edit')
        <a href="{{ route('projets.edit', $id) }}" class="btn btn-icon btn-rounded btn-success"
            title="{{ __('inputs.btn_edit') }}">
            <i class="feather icon-edit"></i>
        </a>
    @endcan
    @can('projet-achat-delete')
        <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
            title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
            <i class="feather icon-trash-2"></i>
        </button>
    @endcan
    @can('preparation-dossier-achat')
        <button type="button" data-id='{{ $id }}' class="btn btn-info feather icon-plus-circle"
            title="إعداد ملف شراء" id="tbl_btn_transferDA"
            onclick="tranfererDA({{ $id }}, '{{ $nature_passation }}')">ملف شراء</button>
    @endcan
@endif
