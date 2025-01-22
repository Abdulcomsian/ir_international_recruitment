@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Quiz Category ({{ $quebecLegalAspectQuiz->quebecLegalAspect->title ?? '' }})</h1>
        <form action="{{ route('quebec.legal-aspects.quiz.update', ['id' => $quebecLegalAspectQuiz->quebec_legal_aspect_id,'quiz' => $quebecLegalAspectQuiz->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($quebecLegalAspectQuiz->featured_image)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ asset($quebecLegalAspectQuiz->featured_image) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" />
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
                @error('featured_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $quebecLegalAspectQuiz->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ old('link', $quebecLegalAspectQuiz->description) }}" required />
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-2">Update Quiz Category</button>
        </form>
    </div>
@endsection
