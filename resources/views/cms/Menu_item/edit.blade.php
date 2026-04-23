@extends('cms.parent')

@section('title')
    Edit Menu Item
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Menu Item</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="Item_Name">Item Name</label>
                    <input type="text" class="form-control" id="Item_Name" name="Item_Name"
                        value="{{ $menuItem->Item_Name }}">
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description"
                        name="Description">{{ $menuItem->Description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="Price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="Price" name="Price"
                        value="{{ $menuItem->Price }}">
                </div>
                <div class="form-group">
                    <label for="Status">Status</label>
                    <select class="form-control" id="Status" name="Status">
                        <option value="available" {{ $menuItem->Status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ $menuItem->Status == 'unavailable' ? 'selected' : '' }}>Unavailable
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Spicy_Level">Spicy Level</label>
                    <select class="form-control" id="Spicy_Level" name="Spicy_Level">
                        <option value="none" {{ $menuItem->Spicy_Level == 'none' ? 'selected' : '' }}>None</option>
                        <option value="mild" {{ $menuItem->Spicy_Level == 'mild' ? 'selected' : '' }}>Mild</option>
                        <option value="medium" {{ $menuItem->Spicy_Level == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hot" {{ $menuItem->Spicy_Level == 'hot' ? 'selected' : '' }}>Hot</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Menu_Categories_ID">Category</label>
                    <select class="form-control" id="Menu_Categories_ID" name="Menu_Categories_ID">
                        @foreach($menuCategories as $menuCategory)
                            <option value="{{ $menuCategory->id }}" {{ $menuItem->Menu_Categories_ID == $menuCategory->id ? 'selected' : '' }}>
                                {{ $menuCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" onclick="performUpdate('{{ $menuItem->id }}')" class="btn btn-success">Update</button>
                <a href="{{ route('menu-items.index') }}" class="btn btn-primary">Go Back</a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('Item_Name', document.getElementById('Item_Name').value);
            formData.append('Description', document.getElementById('Description').value);
            formData.append('Price', document.getElementById('Price').value);
            formData.append('Status', document.getElementById('Status').value);
            formData.append('Spicy_Level', document.getElementById('Spicy_Level').value);
            formData.append('Menu_Categories_ID', document.getElementById('Menu_Categories_ID').value);

            storeRoute('/cms/admin/menu-items/update/' + id, formData);
        }
    </script>
@endsection