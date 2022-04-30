<div class="form-group">
    <label class="form-label">{{ __('labels.lbl_role') }}</label>
   
<select class="form-control" id="roles" name="roles[]" multiple>
   
   @foreach ($roles as $role)
   <option value="{{ $role->name }}"
        @if(isset($userRole))
        @foreach($userRole as $item){{$role->name == $item ? 'selected': ''}}   @endforeach
        @endif
       > {{ $role->$name }}</option>
   @endforeach
   
</select>
</div>
