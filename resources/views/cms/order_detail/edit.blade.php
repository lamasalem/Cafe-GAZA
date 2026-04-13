@extends('cms.parent')

@section('title')
    Edit Order Detail
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Order Detail</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="Orders_ID">Order</label>
                <select class="form-control" id="Orders_ID" name="Orders_ID">
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" {{ $orderDetail->Orders_ID == $order->id ? 'selected' : '' }}>
                            Order #{{ $order->id }} - {{ $order->Order_Date }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Menu_Items_ID">Menu Item</label>
                <select class="form-control" id="Menu_Items_ID" name="Menu_Items_ID">
                    @foreach($menuItems as $menuItem)
                        <option value="{{ $menuItem->id }}" {{ $orderDetail->Menu_Items_ID == $menuItem->id ? 'selected' : '' }}>
                            {{ $menuItem->Item_Name }} ({{ $menuItem->Price }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input type="number" class="form-control" id="Quantity" name="Quantity" value="{{ $orderDetail->Quantity }}" min="1">
            </div>
            <div class="form-group">
                <label for="Unit_Price">Unit Price</label>
                <input type="number" step="0.01" class="form-control" id="Unit_Price" name="Unit_Price" value="{{ $orderDetail->Unit_Price }}">
            </div>
            <div class="form-group">
                <label for="Notes">Notes</label>
                <textarea class="form-control" id="Notes" name="Notes">{{ $orderDetail->Notes }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performUpdate('{{ $orderDetail->id }}')" class="btn btn-success">Update</button>
            <a href="{{ route('order-details.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performUpdate(id) {
    let formData = new FormData();
    formData.append('Orders_ID', document.getElementById('Orders_ID').value);
    formData.append('Menu_Items_ID', document.getElementById('Menu_Items_ID').value);
    formData.append('Quantity', document.getElementById('Quantity').value);
    formData.append('Unit_Price', document.getElementById('Unit_Price').value);
    formData.append('Notes', document.getElementById('Notes').value);

    storeRoute('/cms/admin/order-details/update/' + id, formData);
}
</script>
@endsection