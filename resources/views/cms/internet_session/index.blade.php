@extends('cms.parent')

@section('title')
    Internet Sessions
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('internet-sessions.create') }}" class="btn btn-success btn-sm float-right">Add New Session</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order</th>
                        <th>Service</th>
                        <th>Start</th>
                        <th>Status</th>
                        <th>Access Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($internetSessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>Order #{{ $session->order?->id }}</td>
                            <td>{{ $session->internetService?->service_name }}</td>
                            <td>{{ $session->Start_Time }}</td>
                            <td>{{ $session->Status }}</td>
                            <td>{{ $session->Access_Code }}</td>
                            <td>
                                <a href="{{ route('internet-sessions.edit', $session->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="performDestroy({{ $session->id }}, this)" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $internetSessions->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/internet-sessions/' + id, reference);
        }
    </script>
@endsection