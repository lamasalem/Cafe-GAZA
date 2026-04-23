@extends('cms.parent')

@section('title', 'Create Customer')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add New Customer</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Password">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Store</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performStore() {
            let data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                password: document.getElementById('password').value,
            };

            store('/cms/admin/customers', data);
        }
    </script>
@endsection