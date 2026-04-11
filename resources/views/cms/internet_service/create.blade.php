@extends('cms.parent')

@section('title')
    Create Internet Service
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create New Internet Service</h3>
    </div>
    <form id="create-form">
        <div class="card-body">
            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter Service Name">
            </div>
            <div class="form-group">
                <label for="speed">Speed</label>
                <input type="text" class="form-control" id="speed" name="speed" placeholder="Enter Speed">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter Price">
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
            <a href="{{ route('internet-services.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function performStore() {
        let formData = new FormData();
        // قراءة البيانات من الحقول عن طريق الـ id
        formData.append('service_name', document.getElementById('service_name').value);
        formData.append('speed', document.getElementById('speed').value);
        formData.append('price', document.getElementById('price').value);

        // إرسال البيانات للرابط (تأكدي إنه هاد هو نفس مسار الراوت تبعك)
        store('/cms/admin/internet-services', formData);
    }
</script>
@endsection