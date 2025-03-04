@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Quebec History Category </h1>
        <form action="{{ route('quebec-history-categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="title">Featured Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required>
            </div>
            <button type="submit" class="btn btn-success">Create History Category</button>
        </form>
    </div>
@endsection
