@extends('cms.parent')

@section('title')
    Edit Order
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Order</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="Order_Date">Order Date</label>
                <input type="datetime-local" class="form-control" id="Order_Date" name="Order_Date" value="{{ $order->Order_Date }}">
            </div>
            <div class="form-group">
                <label for="Total_Amount">Total Amount</label>
                <input type="number" step="0.01" class="form-control" id="Total_Amount" name="Total_Amount" value="{{ $order->Total_Amount }}">
            </div>
            <div class="form-group">
                <label for="Payment_Method">Payment Method</label>
                <select class="form-control" id="Payment_Method" name="Payment_Method">
                    <option value="cash" {{ $order->Payment_Method == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="credit_card" {{ $order->Payment_Method == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                    <option value="debit_card" {{ $order->Payment_Method == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Dining_Tables_ID">Dining Table</label>
                <select class="form-control" id="Dining_Tables_ID" name="Dining_Tables_ID">
                    @foreach($diningTables as $diningTable)
                        <option value="{{ $diningTable->id }}" {{ $order->Dining_Tables_ID == $diningTable->id ? 'selected' : '' }}>
                            Table {{ $diningTable->table_number }} (Capacity: {{ $diningTable->capacity }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performUpdate('{{ $order->id }}')" class="btn btn-success">Update</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performUpdate(id) {
    let formData = new FormData();
    formData.append('Order_Date', document.getElementById('Order_Date').value);
    formData.append('Total_Amount', document.getElementById('Total_Amount').value);
    formData.append('Payment_Method', document.getElementById('Payment_Method').value);
    formData.append('Dining_Tables_ID', document.getElementById('Dining_Tables_ID').value);

    storeRoute('/cms/admin/orders/update/' + id, formData);
}
</script>
@endsection