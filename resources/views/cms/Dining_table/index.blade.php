@extends('cms.parent')

@section('title')
    Dining Tables
@endsection

@section('css')
<style>
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .btn-show { background-color: #17a2b8; }
    .btn-edit { background-color: #ffc107; color: #212529; }
    .btn-delete { background-color: #dc3545; }
    .action-btn:hover { opacity: 0.85; color: white; }
    .btn-edit:hover { color: #212529; }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
<!-- <h3 class="card-title">Dining Tables</h3>  -->
 <a href="{{ route('dining-tables.create') }}" class="btn btn-success btn-sm float-right">Add New Dining Table</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Table Number</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($diningTables as $diningTable)
                <tr>
                    <td>{{ $diningTable->id }}</td>
                    <td>{{ $diningTable->table_number }}</td>
                    <td>{{ $diningTable->capacity }}</td>
                    <td>{{ $diningTable->status }}</td>
                    <td>
                        <a href="{{ route('dining-tables.show', $diningTable->id) }}" class="action-btn btn-show">
                            <i class="fas fa-eye"></i> Show
                        </a>
                        <a href="{{ route('dining-tables.edit', $diningTable->id) }}" class="action-btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dining-tables.destroy', $diningTable->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        {{ $diningTables->links() }}

    </div>
</div>
@endsection