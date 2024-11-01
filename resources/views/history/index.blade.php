@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Quebec Information History
            <button id="createNewService" class="btn btn-primary float-right">Create New History</button>

            </div>
            <div class="card-body">
                {{ $dataTable->table() }} <!-- This will render the DataTable -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include the necessary DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function() {
            // Add event listener for the Create button
            $('#createNewService').click(function() {
                // Redirect to the create service page
                window.location.href = '{{ route('quebec.history.create') }}'; // Adjust the route as necessary
            });
        });
    </script>
<!-- 
    <script>
       $(document).ready(function() {
    // Check if the DataTable is already initialized
    if ($.fn.dataTable.isDataTable('#services-table')) {
        $('#services-table').DataTable().clear().destroy(); // Destroy the existing DataTable
    }

    $('#services-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('fetch-services') }}', 
            dataSrc: 'data' // Specify where to find the data in the response
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'image_url', name: 'image_url' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
        ]
    });
});

    </script> -->
@endpush
