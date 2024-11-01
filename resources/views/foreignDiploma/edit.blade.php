@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Foreign diploma</h1>
        <form action="{{ route('foreign.diploma.fields.update', $diploma->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $diploma->title) }}" required>
            </div>

            <div class="form-group">
                <label for="featured_image">Image</label>
                <input type="file" class="form-control" id="featured_image" name="media_url">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($diploma->media_url)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ $diploma->media_url }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif
            
            <button type="submit" class="btn btn-success">Update diploma</button>
        </form>
    </div>
@endsection
