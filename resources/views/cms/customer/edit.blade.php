@extends('cms.parent')

@section('title', 'Edit Customer')

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Edit Customer</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $customer->user->name ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $customer->user->email ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" value="{{ $customer->user->phone ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" value="{{ $customer->address }}">
                </div>
                <div class="form-group">
                    <label for="password">Password (Optional)</label>
                    <input type="password" class="form-control" id="password" placeholder="Leave blank to keep current">
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $customer->id }})" class="btn btn-success">Update</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Go Back</a>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performUpdate(id) {
            let data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                password: document.getElementById('password').value,
            };

            update('/cms/admin/customers/' + id, data, '/cms/admin/customers');
        }
    </script>
@endsection