@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Job Search Advice</h1>
        <form action="{{ route('job.search.advice.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="8" name="description" id="description"></textarea>
            </div>


            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="media_url" required>
            </div>
            <button type="submit" class="btn btn-success">Create Job Search Advice</button>
        </form>
    </div>
@endsection
