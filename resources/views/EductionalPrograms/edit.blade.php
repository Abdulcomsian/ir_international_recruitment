@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit University</h1>
        <form action="{{ route('eductional.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $program->title) }}" required>
            </div>

            <div class="form-group">
                <label for="category">University Type</label>
                <select class="form-control" id="university_type" name="university_type" required>
                    <option value="">Select</option>
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <div class="form-group">
                <label for="label">Location</label>
                <input type="text" class="form-control" id="label" name="location" value="{{ old('location', $program->location) }}" required>
            </div>
            
            <div class="form-group">
                <label for="image"> Image</label>
                <input type="file" class="form-control" id="image" name="featured_image">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($program->featured_image)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ $program->featured_image }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif
            
            <button type="submit" class="btn btn-success">Update University</button>
        </form>
    </div>
@endsection
