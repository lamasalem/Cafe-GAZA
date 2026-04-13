@extends('cms.parent')

@section('title')
    Orders
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('orders.create') }}" class="btn btn-success btn-sm float-right">Add New Order</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Table</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->Order_Date }}</td>
                    <td>{{ $order->Total_Amount }}</td>
                    <td>{{ $order->Payment_Method }}</td>
                    <td>Table {{ $order->diningTable?->table_number }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Show
                        </a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="#" onclick="performDestroy({{ $order->id }}, this)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
function performDestroy(id, reference) {
    confirmDestroy('/cms/admin/orders/' + id, reference);
}
</script>
@endsection