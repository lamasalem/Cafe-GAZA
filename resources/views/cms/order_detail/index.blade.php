@extends('cms.parent')

@section('title')
    Order Details
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('order-details.create') }}" class="btn btn-success btn-sm float-right">Add New Order Detail</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order</th>
                    <th>Menu Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->id }}</td>
                    <td>Order #{{ $orderDetail->order?->id }}</td>
                    <td>{{ $orderDetail->menuItem?->Item_Name }}</td>
                    <td>{{ $orderDetail->Quantity }}</td>
                    <td>{{ $orderDetail->Unit_Price }}</td>
                    <td>
                        <a href="{{ route('order-details.show', $orderDetail->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('order-details.edit', $orderDetail->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" onclick="performDestroy({{ $orderDetail->id }}, this)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orderDetails->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
function performDestroy(id, reference) {
    confirmDestroy('/cms/admin/order-details/' + id, reference);
}
</script>
@endsection