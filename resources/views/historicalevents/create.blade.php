@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create New Major Historical Events</h1>
        <form action="{{ route('quebec.historical.event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">History Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="title">History Description</label>
                <input type="text" class="form-control" id="title" name="description" required>
            </div>
            <div class="form-group">
                <label for="title">Featured Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required>
            </div>
            <div class="form-group">
                <label for="title">Details</label>
                <textarea class="form-control" rows="8" name="details" id="details"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Extra Images</label>
                <input type="file" class="form-control" id="image" name="extra_images" required>
            </div>
            <button type="submit" class="btn btn-success">Create History</button>
        </form>
    </div>
@endsection
