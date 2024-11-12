@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Current Trend</h1>
        <form action="{{ route('quebec.current.trend.update', $trend->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $trend->title) }}" required>
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
                <label for="image">Service Image</label>
                <input type="file" class="form-control" id="image" name="media_url">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($trend->media_url)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset($trend->media_url) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif
            
            <button type="submit" class="btn btn-success">Update Trend</button>
        </form>
    </div>
@endsection
