@extends('cms.parent')

@section('title')
    Create Employee
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Employee</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="Job_Title">Job Title</label>
                <input type="text" class="form-control" id="Job_Title" name="Job_Title" placeholder="Enter Job Title">
            </div>
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
            <a href="{{ route('employees.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performStore() {
    let formData = new FormData();
    formData.append('Job_Title', document.getElementById('Job_Title').value);
    formData.append('Email', document.getElementById('Email').value);
    formData.append('Password', document.getElementById('Password').value);

    store('/cms/admin/employees', formData);
}
</script>
@endsection