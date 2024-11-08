@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Quebec Legal Aspect</h1>
        <form action="{{ route('quebec.legal-aspects.update', $quebecLegalAspect->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($quebecLegalAspect->image_path)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ $quebecLegalAspect->image_path }}" alt="Current Image" class="img-size-1" />
                </div>
            @endif

            <div class="form-group">
                <label for="Image">Image</label>
                <input type="file" class="form-control" id="image" name="img" />
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $quebecLegalAspect->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $quebecLegalAspect->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Quebec Legal Aspect</button>
        </form>
    </div>
@endsection
