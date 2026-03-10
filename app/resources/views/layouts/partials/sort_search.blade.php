<div class="col-md-2">
    <label for="sort" class="form-label">並び替え</label>
    <select name="sort" id="sort" class="form-control">
        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ $newest }}</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ $oldest }}</option>
        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>{{ $title_asc }}</option>
        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>{{ $title_desc }}</option>
    </select>
</div>