@extends('cms.parent')

@section('title')
    Edit Internet Service
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Data of Internet Service</h3>
    </div>
    <form>
        <div class="card-body">
            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" value="{{ $internetService->service_name }}">
            </div>
            <div class="form-group">
                <label for="speed">Speed</label>
                <input type="text" class="form-control" id="speed" name="speed" value="{{ $internetService->speed }}">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $internetService->price }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('internet-services.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection