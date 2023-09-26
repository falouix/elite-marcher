
@if($projets_id)
<a href="{{route('pais.show',['projet'=>$projets_id,'id'=>$id])}}" class="btn btn-icon btn-rounded btn-primary"
    title="عرض تفاصيل الحاجيات" target="_blank" >
        <i class="feather icon-eye"></i>
    </a>
@endif
<button type="button" data-id='{{ $id }}' id="tbl_btn_delete" class="btn btn-icon btn-rounded btn-danger"
title="{{ __('inputs.btn_delete') }}" onclick="deleteFromDataTableBtn({{ $id }})">
<i class="feather icon-trash-2"> </i>
</button>
