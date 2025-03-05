@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Employee Statistics</h1>
        <form action="{{ route('quebec.statistics.cards.update', $state->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->

           

            <div class="form-group">
                <label for="label">Video Url</label>
                <input type="text" class="form-control" id="label" name="video_url" value="{{ old('video_url', $state->video_url) }}" required>
            </div>

            <div class="form-group">
                <label for="image"> Image</label>
                <input type="file" class="form-control" id="image" name="media_url">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($state->media_url)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset($state->media_url) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <button type="submit" class="btn btn-success">Update Employee Statistices</button>
        </form>
    </div>
@endsection
