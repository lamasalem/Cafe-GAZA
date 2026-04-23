@extends('cms.parent')

@section('title')
    Menu Items
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('menu-items.create') }}" class="btn btn-success btn-sm float-right">Add New Menu Item</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuItems as $menuItem)
                        <tr>
                            <td>{{ $menuItem->id }}</td>
                            <td>{{ $menuItem->Item_Name }}</td>
                            <td>{{ $menuItem->Price }}</td>
                            <td>{{ $menuItem->Status }}</td>
                            <td>{{ $menuItem->menuCategory?->name }}</td>
                            <td>
                                <a href="{{ route('menu-items.show', $menuItem->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Show
                                </a>
                                <a href="{{ route('menu-items.edit', $menuItem->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="#" onclick="performDestroy({{ $menuItem->id }}, this)" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $menuItems->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/menu-items/' + id, reference);
        }
    </script>
@endsection