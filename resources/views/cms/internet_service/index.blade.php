@extends('cms.parent')

@section('title')
    Internet Services
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
        <!-- <h3 class="card-title">Internet Services</h3> -->
         <a href="{{ route('internet-services.create') }}" class="btn btn-success btn-sm float-right">Add New Service</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Speed</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($internetServices as $internetService)
                <tr>
                    <td>{{ $internetService->id }}</td>
                    <td>{{ $internetService->service_name }}</td>
                    <td>{{ $internetService->speed }}</td>
                    <td>{{ $internetService->price }}</td>
                    <td>
                        <a href="{{ route('internet-services.show', $internetService->id) }}" class="action-btn btn-show">
                            <i class="fas fa-eye"></i> Show
                        </a>
                        <a href="{{ route('internet-services.edit', $internetService->id) }}" class="action-btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('internet-services.destroy', $internetService->id) }}" method="POST" style="display:inline">
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
        {{ $internetServices->links() }}

    </div>
</div>
@endsection