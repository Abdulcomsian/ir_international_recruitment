@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create City Video</h1>
        <form action="{{ route('cities.upload-cityVideo.store',$id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="video_url">Video Url</label>
                <input type="url" class="form-control" id="video_url" name="video_url" required>
            </div>

            <div class="form-group">
                <label for="is_Active">is Active</label>
                <select class="form-control" id="is_Active" name="is_Active" required>
                    <option value="">Select Category</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Create City Video</button>
        </form>
    </div>
@endsection
