@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create City Guide Category</h1>
        <form action="{{ route('city.guide.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="url" name="url" required>
            </div>

            <button type="submit" class="btn btn-success">Create CityCategory</button>
        </form>
    </div>
@endsection
