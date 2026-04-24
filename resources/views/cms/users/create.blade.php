@extends('cms.parent')

@section('title')
    Create User
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New User</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control">
                        <option value="employee">Employee</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('role', document.getElementById('role').value);


            store('/cms/admin/users', formData);
        }
    </script>
@endsection