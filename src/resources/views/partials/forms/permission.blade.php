<div class="form-group">
    <label>Name: *</label>
    <input type="text" class="form-control" name="name" value="@if(isset($permission)){{$permission->name}}@endif">
</div>
<div class="form-group">
    <label>Slug: *</label>
    <input type="text" class="form-control" name="slug" value="@if(isset($permission)){{$permission->slug}}@endif">
</div>
<p class="button-group">
    <button type="submit" class="btn btn-primary">Save</button>
	<a href="{{ url('admin/permissions') }}" class="btn-alt">Cancel</a>
</p>
