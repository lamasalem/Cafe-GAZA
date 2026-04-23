@extends('cms.parent')

@section('title', 'Customers List')

@section('page-name', 'Index Customer')
@section('main-page', 'Customer')
@section('sub-page', 'Index')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customers List</h3>
                            <div class="card-tools">
                                <a href="{{ route('customers.create') }}" class="btn btn-success">Add New Customer</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>address</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->user->name ?? 'N/A' }}</td>
                                            <td>{{ $customer->user->email ?? 'N/A' }}</td>
                                            <td>{{ $customer->user->phone ?? 'N/A' }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>
                                                <a href="{{ route('customers.edit', $customer->id) }}"
                                                    class="btn btn-warning btn-sm me-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <a href="#" onclick="performDestroy({{ $customer->id }}, this)"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            confirmDestroy('/cms/admin/customers/' + id, reference);
        }
    </script>
@endsection