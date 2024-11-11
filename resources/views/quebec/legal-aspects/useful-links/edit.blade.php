@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Useful Link ({{ $quebecLegalAspectUsefulLink->quebecLegalAspect->title ?? '' }})</h1>
        <form action="{{ route('quebec.legal-aspects.useful-links.update', ['id' => $quebecLegalAspectUsefulLink->quebec_legal_aspect_id,'useful_link' => $quebecLegalAspectUsefulLink->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $quebecLegalAspectUsefulLink->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link"
                    value="{{ old('link', $quebecLegalAspectUsefulLink->link) }}" required />
                @error('link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-2">Update Useful Link</button>
        </form>
    </div>
@endsection
