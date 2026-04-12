@extends('cms.parent')

@section('title')
    Menu Categories
@endsection

@section('content')
<div class="card">
    <div class="card-header">
         <a href="{{ route('menu-categories.create') }}" class="btn btn-success btn-sm float-right">Add New Category</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuCategories as $menuCategory)
                <tr>
                    <td>{{ $menuCategory->id }}</td>
                    <td>{{ $menuCategory->name }}</td>
                    <td>{{ $menuCategory->status }}</td>
                    <td>
                        <a href="{{ route('menu-categories.show', $menuCategory->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Show
                        </a>
                        <a href="{{ route('menu-categories.edit', $menuCategory->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" onclick="performDestroy({{ $menuCategory->id }}, this)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $menuCategories->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
function performDestroy(id, reference) {
    confirmDestroy('/cms/admin/menu-categories/' + id, reference);
}
</script>
@endsection