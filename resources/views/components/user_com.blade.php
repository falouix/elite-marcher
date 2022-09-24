<div class="form-group">
    <label class="form-label">التصنيف </label>
    <select class="form-control" name="user_type">
        <option value="">إختر التصنيف ...</option>
        <option value="comOffres" {{ $userType == 'comOffres' ? 'selected' : '' }}>عضو لجنة صفقات</option>
        <option value="comAchats" {{ $userType == 'comAchats' ? 'selected' : '' }}>عضو لجنة شراءات</option>
    </select>
</div>
