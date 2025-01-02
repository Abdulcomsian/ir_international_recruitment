@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Job Search Advice</h1>
        <form action="{{ route('job.search.advice.update', $jobsearch->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $jobsearch->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $jobsearch->description) }}" required>
            </div>

            <div class="form-group">
                <label for="featured_image">Image</label>
                <input type="file" class="form-control" id="featured_image" name="media_url">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($jobsearch->media_url)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset($jobsearch->media_url) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <button type="submit" class="btn btn-success">Update Job Search Advice</button>
        </form>
    </div>
@endsection
