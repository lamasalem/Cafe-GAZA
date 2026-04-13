@extends('cms.parent')

@section('title')
    Create Customer
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Customer</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter Password">
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
            <a href="{{ route('customers.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performStore() {
    let formData = new FormData();
    formData.append('Email', document.getElementById('Email').value);
    formData.append('Password', document.getElementById('Password').value);

    store('/cms/admin/customers', formData);
}
</script>
@endsection