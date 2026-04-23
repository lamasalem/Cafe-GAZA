@extends('cms.parent')

@section('title')
    Create Internet Session
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New Internet Session</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="Orders_ID">Order</label>
                    <select class="form-control" id="Orders_ID" name="Orders_ID">
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">Order #{{ $order->id }} - {{ $order->Order_Date }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Internet_Services_ID">Internet Service</label>
                    <select class="form-control" id="Internet_Services_ID" name="Internet_Services_ID">
                        @foreach($internetServices as $service)
                            <option value="{{ $service->id }}">{{ $service->service_name }} ({{ $service->speed }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Start_Time">Start Time</label>
                    <input type="datetime-local" class="form-control" id="Start_Time" name="Start_Time">
                </div>
                <div class="form-group">
                    <label for="End_Time">End Time</label>
                    <input type="datetime-local" class="form-control" id="End_Time" name="End_Time">
                </div>
                <div class="form-group">
                    <label for="Access_Code">Access Code</label>
                    <input type="text" class="form-control" id="Access_Code" name="Access_Code"
                        placeholder="Enter Access Code">
                </div>
                <div class="form-group">
                    <label for="Status">Status</label>
                    <select class="form-control" id="Status" name="Status">
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
                <a href="{{ route('internet-sessions.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('Orders_ID', document.getElementById('Orders_ID').value);
            formData.append('Internet_Services_ID', document.getElementById('Internet_Services_ID').value);
            formData.append('Start_Time', document.getElementById('Start_Time').value);
            formData.append('End_Time', document.getElementById('End_Time').value);
            formData.append('Access_Code', document.getElementById('Access_Code').value);
            formData.append('Status', document.getElementById('Status').value);

            store('/cms/admin/internet-sessions', formData);
        }
    </script>
@endsection