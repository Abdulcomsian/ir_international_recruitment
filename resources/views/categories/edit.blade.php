@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>City Guide Categories</h1>
        <form action="{{ route('city.guide.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->

            <div class="form-group">
                <label for="image"> Image</label>
                <input type="file" class="form-control" id="image" name="featured_image">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($category->featured_image)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset($category->featured_image) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $category->title) }}" required>
            </div>

            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $category->url) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update CityCategory</button>
        </form>
    </div>
@endsection
