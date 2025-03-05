@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Beauty Card</h1>
        <form action="{{ route('quebec.statistics.cards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="video_url">Video Url</label>
                <input type="text" class="form-control" id="video_url" name="video_url" >
            </div>

            <div class="form-group">
                <label for="title">Logo</label>
                <input type="file" class="form-control" id="image" name="media_url" >
            </div>
            <button type="submit" class="btn btn-success">Create Beauty Card</button>
        </form>
    </div>
@endsection
