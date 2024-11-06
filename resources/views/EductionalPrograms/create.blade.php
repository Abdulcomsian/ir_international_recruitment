@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create University</h1>
        <form action="{{ route('eductional.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf   
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
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
                <label for="title">location</label>
                <input type="text" class="form-control" id="title" name="location" required>
            </div>

            <div class="form-group">
                <label for="title">featured_image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Create University</button>
        </form>
    </div>
@endsection
