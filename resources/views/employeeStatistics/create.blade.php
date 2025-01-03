@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Employee Statistics</h1>
        <form action="{{ route('quebec.employee.statistics.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="title">Statistics</label>
                <input type="text" class="form-control" id="title" name="state" required>
            </div>

            <div class="form-group">
                <label for="title">Label</label>
                <input type="text" class="form-control" id="title" name="label" required>
            </div>

            <div class="form-group">
                <label for="title">Logo</label>
                <input type="file" class="form-control" id="image" name="media_url" required>
            </div>
            <button type="submit" class="btn btn-success">Create Employee Statistics</button>
        </form>
    </div>
@endsection
