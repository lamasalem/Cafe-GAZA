@extends('cms.parent')

@section('title')
    Edit Internet Session
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Internet Session</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="Orders_ID">Order</label>
                <select class="form-control" id="Orders_ID" name="Orders_ID">
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" {{ $internetSession->Orders_ID == $order->id ? 'selected' : '' }}>
                            Order #{{ $order->id }} - {{ $order->Order_Date }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Internet_Services_ID">Internet Service</label>
                <select class="form-control" id="Internet_Services_ID" name="Internet_Services_ID">
                    @foreach($internetServices as $service)
                        <option value="{{ $service->id }}" {{ $internetSession->Internet_Services_ID == $service->id ? 'selected' : '' }}>
                            {{ $service->service_name }} ({{ $service->speed }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Start_Time">Start Time</label>
                <input type="datetime-local" class="form-control" id="Start_Time" name="Start_Time" value="{{ $internetSession->Start_Time }}">
            </div>
            <div class="form-group">
                <label for="End_Time">End Time</label>
                <input type="datetime-local" class="form-control" id="End_Time" name="End_Time" value="{{ $internetSession->End_Time }}">
            </div>
            <div class="form-group">
                <label for="Access_Code">Access Code</label>
                <input type="text" class="form-control" id="Access_Code" name="Access_Code" value="{{ $internetSession->Access_Code }}">
            </div>
            <div class="form-group">
                <label for="Status">Status</label>
                <select class="form-control" id="Status" name="Status">
                    <option value="active" {{ $internetSession->Status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ $internetSession->Status == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="cancelled" {{ $internetSession->Status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performUpdate('{{ $internetSession->id }}')" class="btn btn-success">Update</button>
            <a href="{{ route('internet-sessions.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performUpdate(id) {
    let formData = new FormData();
    formData.append('Orders_ID', document.getElementById('Orders_ID').value);
    formData.append('Internet_Services_ID', document.getElementById('Internet_Services_ID').value);
    formData.append('Start_Time', document.getElementById('Start_Time').value);
    formData.append('End_Time', document.getElementById('End_Time').value);
    formData.append('Access_Code', document.getElementById('Access_Code').value);
    formData.append('Status', document.getElementById('Status').value);

    storeRoute('/cms/admin/internet-sessions-update/' + id, formData);
}
</script>
@endsection