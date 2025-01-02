@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create New Trend</h1>
        <form action="{{ route('quebec.current.trend.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="growing_sectors">Growing Sectors</option>
                    <option value="demand_professionals">In demand Professions</option>
                </select>
            </div>


            <div class="form-group">
                <label for="title">Image</label>
                <input type="file" class="form-control" id="image" name="media_url" required>
            </div>
            <button type="submit" class="btn btn-success">Create History</button>
        </form>
    </div>
@endsection
