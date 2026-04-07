@extends('cms.parent')

@section('title')
    Edit Dining Table
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data of Dining Table</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="table_number">Table Number</label>
                <input type="number" class="form-control" id="table_number" name="table_number" value="{{ $diningTable->table_number }}">
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $diningTable->capacity }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="available" {{ $diningTable->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ $diningTable->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="reserved" {{ $diningTable->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('dining-tables.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection