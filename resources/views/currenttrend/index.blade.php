@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Current Trends
            <button id="createNewService" class="btn btn-primary float-right">Create Current Trend</button>

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
                window.location.href = '{{ route('quebec.current.trend.create') }}'; // Adjust the route as necessary
            });
        });
    </script>

@endpush
