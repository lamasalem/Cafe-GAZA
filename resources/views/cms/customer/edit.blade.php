@extends('cms.parent')

@section('title')
    Edit Customer
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Customer</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="{{ $customer->Email }}">
            </div>
            <div class="form-group">
                <label for="Password">New Password (leave empty to keep current)</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter New Password">
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performUpdate('{{ $customer->id }}')" class="btn btn-success">Update</button>
            <a href="{{ route('customers.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performUpdate(id) {
    let formData = new FormData();
    formData.append('Email', document.getElementById('Email').value);
    formData.append('Password', document.getElementById('Password').value);

    storeRoute('/cms/admin/customers/update/' + id, formData);
}
</script>
@endsection