@extends('cms.parent')

@section('title', 'Index Employee')

@section('page-name', 'Index Employee')
@section('main-page', 'Employee')
@section('sub-page', 'Index')

@section('styles')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employees List</h3>
                            <div class="card-tools">
                                <a href="{{ route('employees.create') }}" class="btn btn-success">Add New Employee</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        <th>Job Title</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th style="width: 150px">Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->user->name ?? 'No Name' }}</td>
                                            <td>{{ $employee->job_title }}</td>
                                            <td>{{ $employee->user->email ?? 'N/A' }}</td>
                                            <td>{{ $employee->user->phone ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn btn-warning btn-sm me-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <a href="#" onclick="performDestroy({{ $employee->id }}, this)"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/employees/' + id, reference);
        }
    </script>
@endsection