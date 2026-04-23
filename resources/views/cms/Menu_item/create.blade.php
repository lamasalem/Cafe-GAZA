@extends('cms.parent')

@section('title')
    Create Menu Item
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create New Menu Item</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="Item_Name">Item Name</label>
                    <input type="text" class="form-control" id="Item_Name" name="Item_Name" placeholder="Enter Item Name">
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description" name="Description"
                        placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="Price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="Price" name="Price" placeholder="Enter Price">
                </div>
                <div class="form-group">
                    <label for="Status">Status</label>
                    <select class="form-control" id="Status" name="Status">
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Spicy_Level">Spicy Level</label>
                    <select class="form-control" id="Spicy_Level" name="Spicy_Level">
                        <option value="none">None</option>
                        <option value="mild">Mild</option>
                        <option value="medium">Medium</option>
                        <option value="hot">Hot</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Menu_Categories_ID">Category</label>
                    <select class="form-control" id="Menu_Categories_ID" name="Menu_Categories_ID">
                        @foreach($menuCategories as $menuCategory)
                            <option value="{{ $menuCategory->id }}">{{ $menuCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-success">Submit</button>
                <a href="{{ route('menu-items.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('Item_Name', document.getElementById('Item_Name').value);
            formData.append('Description', document.getElementById('Description').value);
            formData.append('Price', document.getElementById('Price').value);
            formData.append('Status', document.getElementById('Status').value);
            formData.append('Spicy_Level', document.getElementById('Spicy_Level').value);
            formData.append('Menu_Categories_ID', document.getElementById('Menu_Categories_ID').value);

            store('/cms/admin/menu-items', formData);
        }
    </script>
@endsection