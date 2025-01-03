@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit History</h1>
        <form action="{{ route('quebec.history.update', $history->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">History Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $history->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">History Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $history->description) }}" required>
            </div>

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($featuredImage)
                <div class="form-group">
                    <label>Current Featured Image</label><br>
                    <img src="{{ asset("assets/QuebecHistory_images/$featuredImage->media_url") }}" alt="Current Featured Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <div class="form-group">
                <label for="details">Details</label>
                <textarea class="form-control" rows="8" name="details" id="details">{{ old('details', $history->details) }}</textarea>
            </div>

            <div class="form-group">
                <label for="extra_images">Extra Images</label>
                <input type="file" class="form-control" id="extra_images" name="extra_images[]" multiple>
                <small class="form-text text-muted">Leave blank if you don't want to change the images.</small>
            </div>

            @if($extraImages->count())
                <div class="form-group">
                    <label>Current Extra Images</label><br>
                    @foreach($extraImages as $image)
                        <img src="{{ asset("assets/QuebecHistory_images/$image->media_url") }}" alt="Current Extra Image" style="width: 150px; height: auto; margin-right: 10px;">
                    @endforeach
                </div>
            @endif

            <button type="submit" class="btn btn-success">Update History</button>
        </form>
    </div>
@endsection
