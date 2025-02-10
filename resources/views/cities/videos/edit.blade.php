@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit City Videos</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cities.upload-cityVideo.update', [$city->id, $uploadCityVideo->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="video_url">Video URL</label>
            <input type="text" class="form-control" id="video_url" name="video_url" value="{{ old('video_url', $uploadCityVideo->video_url) }}" required>
        </div>
        
        <div class="form-group">
            <label for="is_Active">Active Status</label>
            <select name="is_Active" id="is_Active" class="form-control" required>
                <option value="yes" {{ $uploadCityVideo->is_active === 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $uploadCityVideo->is_active === 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="featured_image">Featured Image</label>
            @if ($uploadCityVideo->featured_image)
                <div>
                    <img src="{{ asset($uploadCityVideo->featured_image) }}" alt="Featured Image" style="width: 150px; height: auto;">
                </div>
            @endif
            <input type="file" name="featured_image" id="featured_image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
</div>
@endsection
