@extends('cms.parent')

@section('title')
    Show Menu Category Details
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Category: <b>{{ $menuCategory->name }}</b></h3>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Category Name:</strong> {{ $menuCategory->name }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge {{ $menuCategory->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $menuCategory->status }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Created At:</strong> {{ $menuCategory->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

            <hr>

            <h4 class="mb-3">Items in this Category</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menuCategory->menuItems as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->Item_Name }}</td>
                            <td><span class="text-success">${{ number_format($item->Price, 2) }}</span></td>
                            <td>{{ $item->Status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No items added to this category yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <a href="{{ route('menu-categories.edit', $menuCategory->id) }}" class="btn btn-warning">Edit Category</a>
            <a href="{{ route('menu-categories.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
@endsection