@if ($locale == 'ar')
    <div class="form-group">
        <label class="form-label">التصنيف </label>
        <select class="form-control" name="user_type">
            <option value="">إختر التصنيف ...</option>

            <option value="chairman" {{ $userType == 'chairman' ? 'selected' : '' }}>رئيس تنفيذي</option>
            <option value="lawyer" {{ $userType == 'lawyer' ? 'selected' : '' }}>محامي</option>
            <option value="accountant" {{ $userType == 'accountant' ? 'selected' : '' }}>محاسب</option>
            <option value="business_manager" {{ $userType == 'business_manager' ? 'selected' : '' }}>إدارة أعمال/ الموارد
                البشرية</option>
            <option value="receptionist" {{ $userType == 'receptionist' ? 'selected' : '' }}>موظف إستقبال </option>
        </select>
    </div>
@else
    <div class="form-group">
        <label class="form-label">User Type</label>
        <select class="form-control" name="user_type">
            <option value="">Select type...</option>

            <option value="chairman" {{ $userType == 'chairman' ? 'selected' : '' }}>Chairman</option>
            <option value="lawyer" {{ $userType == 'lawyer' ? 'selected' : '' }}>Lawyer</option>
            <option value="accountant" {{ $userType == 'accountant' ? 'selected' : '' }}>Accountant</option>
            <option value="business_manager" {{ $userType == 'business_manager' ? 'selected' : '' }}>Business Manager/HR
            </option>
            <option value="receptionist" {{ $userType == 'receptionist' ? 'selected' : '' }}>Receptionist </option>
        </select>
    </div>
@endif
