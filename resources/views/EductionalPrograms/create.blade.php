@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create University</h1>
        <form action="{{ route('eductional.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="category">University Type</label>
                <select class="form-control" id="university_type" name="university_type" required>
                    <option value="">Select</option>
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="cityId" name="city_id" required>
                    <option value="">Select</option>
                    @forelse ($cities as $city)

                        <option value="{{ $city->id }}">{{ $city->name }}</option>

                    @empty
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label for="title">Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required>
            </div>
            <button type="submit" class="btn btn-success">Create University</button>
        </form>
    </div>
@endsection
