@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Service</h1>
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->

            <div class="form-group">
                <label for="title">Service Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title) }}" required>
            </div>
            <div class="form-group">
                <label for="image">Service Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($service->image_url)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset($service->image_url) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <button type="submit" class="btn btn-success">Update Service</button>
        </form>
    </div>
@endsection
