@extends('cms.parent')

@section('title')
    Create Menu Category
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Menu Category</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
            <a href="{{ route('menu-categories.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performStore() {
    let formData = new FormData();
    formData.append('name', document.getElementById('name').value);
    formData.append('status', document.getElementById('status').value);

    store('/cms/admin/menu-categories', formData);
}
</script>
@endsection