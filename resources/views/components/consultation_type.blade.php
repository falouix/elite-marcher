@if ($locale == 'ar')
    <div class="form-group">
        <label class="form-label">نوع العرض </label>
        <select class="form-control" id="offer_from" name="offer_from">
            <option value="">إختر التصنيف ...</option>

            <option value="Case"> عرض على قضية </option>
            <option value="Consultation">عرض على إستشارة</option>
            <option value="Prosecution">عرض على دعوى</option>
            <option value="Others">نوع أخر</option>
            
        </select>
    </div>
@else
    <div class="form-group">
        <label class="form-label">User Type</label>
        <select class="form-control" name="user_type">
            <option value="">Select Offer type...</option>

            
            <option value="Case"> Offer for a Case  </option>
            <option value="Consultation">Offer for a Consultation</option>
            <option value="Prosecution">Offer for a Prosecution</option>
            <option value="Others">Ohter Offer</option>
        </select>
    </div>
@endif
