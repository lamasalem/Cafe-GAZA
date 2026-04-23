@extends('cms.parent')

@section('title')
    Edit Menu Category
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data of Menu Category</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $menuCategory->name }}">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="active" {{ $menuCategory->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $menuCategory->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performUpdate('{{ $menuCategory->id }}')"
                    class="btn btn-success">Update</button>
                <a href="{{ route('menu-categories.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('status', document.getElementById('status').value);

            storeRoute('/cms/admin/menu-categories/update/' + id, formData);
        }
    </script>
@endsection