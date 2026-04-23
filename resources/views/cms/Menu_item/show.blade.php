@extends('cms.parent')

@section('title')
    Show Menu Item Details
@endsection

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">
                Item: <b>{{ $menuItem->Item_Name }}</b>
            </h3>
        </div>

        <div class="card-body">
            <div class="row mb-4">

                <div class="col-md-6">
                    <p><strong>Item Name:</strong> {{ $menuItem->Item_Name }}</p>

                    <p><strong>Description:</strong>
                        {{ $menuItem->Description ?? 'No description available' }}
                    </p>

                    <p><strong>Price:</strong>
                        <span class="text-success">
                            ${{ number_format($menuItem->Price, 2) }}
                        </span>
                    </p>

                    <p><strong>Status:</strong>
                        <span class="badge {{ $menuItem->Status == 'available' ? 'bg-success' : 'bg-danger' }}">
                            {{ $menuItem->Status }}
                        </span>
                    </p>
                </div>

                <div class="col-md-6">
                    <p><strong>Category:</strong>
                        {{ $menuItem->menuCategory->name ?? 'No Category' }}
                    </p>

                    <p><strong>Spicy Level:</strong>
                        {{ $menuItem->Spicy_Level ?? 'N/A' }}
                    </p>

                    <p><strong>Created At:</strong>
                        {{ $menuItem->created_at->format('Y-m-d') }}
                    </p>
                </div>

            </div>

            <hr>

            <h4 class="mb-3">Related Info</h4>

            <div class="alert alert-info">
                This item belongs to category:
                <b>{{ $menuItem->menuCategory->name ?? 'N/A' }}</b>
            </div>

        </div>

        <div class="card-footer">
            <a href="{{ route('menu-items.edit', $menuItem->id) }}" class="btn btn-warning">
                Edit Item
            </a>

            <a href="{{ route('menu-items.index') }}" class="btn btn-primary">
                Go Back
            </a>
        </div>
    </div>
@endsection