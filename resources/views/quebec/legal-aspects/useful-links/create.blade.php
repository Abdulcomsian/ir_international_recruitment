@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New Useful Link ({{ $quebecLegalAspect->title }})</h1>
        <form action="{{ route('quebec.legal-aspects.useful-links.store',$quebecLegalAspect->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" required />
                @error('link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-2">Create Useful Link</button>
        </form>
    </div>
@endsection
