@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New Quebec Climate</h1>
        <form action="{{ route('quebec.climates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Image">Image</label>
                <input type="file" class="form-control" id="image" name="img" required />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="btn btn-success">Create Quebec Climate</button>
        </form>
    </div>
@endsection
