


@if($valider == false)
<button  class="btn btn-icon btn-rounded btn-primary"
        title="تفعيل المادة" onclick="validerArticle({{ $id }})">
        <i class="feather icon-edit-1"></i>
</button>
@endif


    <a href="#" class="btn btn-icon btn-rounded btn-success" data-id="{{  $id }}"
        title="{{ __('inputs.btn_edit') }}" onclick="editArticle({{ $id }})">
        <i class="feather icon-edit"></i>
    </a>



    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"> </i>
    </button>




