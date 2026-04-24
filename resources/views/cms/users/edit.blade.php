@extends('cms.parent')

@section('title')
    Edit User
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit User Data</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="password">Password (Leave blank to keep current password)</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter new password if you want to change it">
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control">
                        <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
                        <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" onclick="performUpdate('{{ $user->id }}')" class="btn btn-warning">Update</button> <a
                    href="{{ route('users.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('role', document.getElementById('role').value);

            // استخدام دالة الدكتور مع تمرير رابط الرجوع كمُدخل ثالث
            storeRoute('/cms/admin/users/update/' + id, formData);
        }
    </script>
@endsection