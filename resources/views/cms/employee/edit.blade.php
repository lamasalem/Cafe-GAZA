@extends('cms.parent')

@section('title', 'Edit Employee')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Employee</h3>
    </div>
    <form id="edit_form">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" value="{{ $employee->user->name ?? '' }}">
            </div>

            <div class="form-group">
                <label for="Job_Title">Job Title</label>
                <input type="text" class="form-control" id="job_title" value="{{ $employee->job_title }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ $employee->user->email ?? '' }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" value="{{ $employee->user->phone ?? '' }}">
            </div>

            <div class="form-group">
                <label for="password">Password (Leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" placeholder="اتركه فارغاً إذا لم ترد تغييره">
            </div>
        </div>
        
        <div class="card-footer">
            <button type="button" onclick="performUpdate({{ $employee->id }})" class="btn btn-success">Update</button>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function performUpdate(id) {
        let data = {
            name: document.getElementById('name').value,
            Job_Title: document.getElementById('job_title').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            password: document.getElementById('password').value,
        };

        // استدعاء دالة التحديث الجاهزة من ملف crud.js
        // بتاخد: (رابط التعديل، البيانات، رابط العودة بعد النجاح)
        update('/cms/admin/employees/' + id, data, '/cms/admin/employees');
    }
</script>
@endsection