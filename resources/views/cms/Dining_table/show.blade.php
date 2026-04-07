@extends('cms.parent')

@section('title')
    Show Dining Table
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Show Data of Dining Table</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="table_number">Table Number</label>
                <input type="number" class="form-control" id="table_number" name="table_number" value="{{ $diningTable->table_number }}" disabled>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $diningTable->capacity }}" disabled>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $diningTable->status }}" disabled>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('dining-tables.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection