@extends('cms.parent')

@section('title')
    Employees
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('employees.create') }}" class="btn btn-success btn-sm float-right">Add New Employee</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Job Title</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->Job_Title }}</td>
                    <td>{{ $employee->Email }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" onclick="performDestroy({{ $employee->id }}, this)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
function performDestroy(id, reference) {
    confirmDestroy('/cms/admin/employees/' + id, reference);
}
</script>
@endsection