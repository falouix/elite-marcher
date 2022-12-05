@can('besoin-file-edit')
    @if ($docs_id)
        <a href="{{ route('file.upload.get', ['id' => $docs_id, 'param' => 'besoin_documents']) }}"
            class="btn btn-icon btn-rounded btn-primary" title="{{ __('inputs.btn_view_file') }}" target="_blank">
            <i class="feather icon-eye"></i>
        </a>

        @if ($valider == false)
            <button type="button" data-id='{{ $docs_id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
                title="{{ __('inputs.btn_delete') }}" onclick="deleteFile({{ $docs_id }})">
                <i class="feather icon-trash-2"></i>
            </button>
        @endif
    @endif
@endcan
