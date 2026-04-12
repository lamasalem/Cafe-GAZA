@extends('cms.parent')

@section('title')
    Users List
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
    .btn-edit { background-color: #ffc107; color: #212529; }
    .btn-delete { background-color: #dc3545; }
    .action-btn:hover { opacity: 0.85; color: white; }
    .btn-edit:hover { color: #212529; }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">System Users</h3>
        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right">Add New User</a>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-danger">Admin</span>
                        @else
                            <span class="badge bg-info">Employee</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="action-btn btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        {{-- $users->links() --}}
    </div>
</div>
@endsection

@section('scripts')
{{-- هنا لا يوجد حاجة لأي JavaScript للحذف لأننا استخدمنا Form عادي --}}
@endsection