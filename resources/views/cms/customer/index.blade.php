@extends('cms.parent')

@section('title')
    Customers
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('customers.create') }}" class="btn btn-success btn-sm float-right">Add New Customer</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->Email }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" onclick="performDestroy({{ $customer->id }}, this)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $customers->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
function performDestroy(id, reference) {
    confirmDestroy('/cms/admin/customers/' + id, reference);
}
</script>
@endsection