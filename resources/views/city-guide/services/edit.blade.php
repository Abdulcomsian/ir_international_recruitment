@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit City Services</h1>
        <form action="{{ route('city-guide.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title) }}" required>
            </div>

            <div class="form-group">
                <label for="keyword">Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" value="{{ old('keyword', $service->keyword) }}" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="often_services" {{ $service->category === 'often_services' ? 'selected' : '' }}>Often Services</option>
                    <option value="other" {{ $service->category === 'others' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update City Service</button>
        </form>
    </div>
@endsection
