@extends('cms.parent')

@section('title')
    Create Menu Category
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Menu Category</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('menu-categories.index') }}" class="btn btn-primary">Go Back</a>
            
        </div>
    </form>
</div>
@endsection