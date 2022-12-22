@if($active)
<a href="#" class="btn btn-icon btn-rounded btn-warning" onclick="suspendCustomerAccount({{ $id }})"
title="تجميد حساب المزود">
    <i class="feather icon-user-minus"></i>
</a>
@else
<a href="#" class="btn btn-icon btn-rounded btn-warning" onclick="createCustomerAccount({{ $id }})"
title="تفعيل حساب المزود">
    <i class="feather icon-user-plus"></i>
</a>
@endif

    <a href="#" class="btn btn-icon btn-rounded btn-success" data-id="{{  $id }}"
        title="{{ __('inputs.btn_edit') }}" onclick="editSoumissionnaire({{ $id }})">
        <i class="feather icon-edit"></i>
    </a>

    <button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
        title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
        <i class="feather icon-trash-2"></i>
    </button>
