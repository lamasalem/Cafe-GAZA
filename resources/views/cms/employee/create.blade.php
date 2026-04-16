@extends('cms.parent')

@section('title', 'Create Employee')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Employee</h3>
    </div>
    <form id="create_form">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Full Name">
            </div>

            <div class="form-group">
                <label for="Job_Title">Job Title</label>
                <input type="text" class="form-control" id="Job_Title" placeholder="Enter Job Title">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password">
            </div>
        </div>
        
        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
function performStore() {
    let formData = new FormData();
    
    formData.append('name', document.getElementById('name').value);
    formData.append('Job_Title', document.getElementById('Job_Title').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('phone', document.getElementById('phone').value);
    formData.append('password', document.getElementById('password').value);

    store('/cms/admin/employees', formData); 
}
</script>
@endsection