@extends('cms.parent')

@section('title')
    Create Order
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New Order</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="Order_Date">Order Date</label>
                    <input type="datetime-local" class="form-control" id="Order_Date" name="Order_Date">
                </div>
                <div class="form-group">
                    <label for="Total_Amount">Total Amount</label>
                    <input type="number" step="0.01" class="form-control" id="Total_Amount" name="Total_Amount"
                        placeholder="Enter Total Amount">
                </div>
                <div class="form-group">
                    <label for="Payment_Method">Payment Method</label>
                    <select class="form-control" id="Payment_Method" name="Payment_Method">
                        <option value="cash">Cash</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Dining_Tables_ID">Dining Table</label>
                    <select class="form-control" id="Dining_Tables_ID" name="Dining_Tables_ID">
                        @foreach($diningTables as $diningTable)
                            <option value="{{ $diningTable->id }}">Table {{ $diningTable->table_number }} (Capacity:
                                {{ $diningTable->capacity }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('Order_Date', document.getElementById('Order_Date').value);
            formData.append('Total_Amount', document.getElementById('Total_Amount').value);
            formData.append('Payment_Method', document.getElementById('Payment_Method').value);
            formData.append('Dining_Tables_ID', document.getElementById('Dining_Tables_ID').value);

            store('/cms/admin/orders', formData);
        }
    </script>
@endsection