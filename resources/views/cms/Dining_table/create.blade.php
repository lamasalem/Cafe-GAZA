@extends('cms.parent')

@section('title')
    Create Dining Table
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Dining Table</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="table_number">Table Number</label>
                <input type="number" class="form-control" id="table_number" name="table_number" placeholder="Enter Table Number">
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter Capacity">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="available">Available</option>
                    <option value="occupied">Occupied</option>
                    <option value="reserved">Reserved</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('dining-tables.index') }}" class="btn btn-primary">Go Back</a>
            
        </div>
    </form>
</div>
@endsection