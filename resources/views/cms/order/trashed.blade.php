@extends('cms.parent')

@section('title', 'Trashed Orders')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Archived Orders</h3>
            <div class="card-tools">
                <a href="{{ route('orders.forceAll') }}" class="btn btn-outline-danger">
                    <i class="fas fa-trash-alt"></i>forceAll</a>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Active Orders</a>

            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Deleted At</th>
                        <th>Settings</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->deleted_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('orders.restore', $order->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-undo"></i> Restore
                                </a>
                                <a href="{{ route('orders.force', $order->id) }}" class="btn btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> Final Delete
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Trash is empty!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function performRestore(id) {
            confirmRoute('/cms/admin/orders/restore/' + id, 'Do you want to restore this order?');
        }

        function performForceDelete(id, reference) {
            confirmDestroy('/cms/admin/orders/force-delete/' + id, reference);
        }
    </script>
@endsection