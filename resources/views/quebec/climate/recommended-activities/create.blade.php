@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New Recommended Activity ({{ $quebecClimate->title }})</h1>
        <form action="{{ route('quebec.climates.recommended-activities.store',$quebecClimate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Image">Image</label>
                <input type="file" class="form-control" id="image" name="img" required />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="">Select</option>
                    <option value="indoor">Indoor</option>
                    <option value="outdoor">Outdoor</option>
                </select>
                @error('type')
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
                <div id="quill-editor" class="bg-white"></div>
                <textarea class="form-control d-none" id="description" name="description" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="btn btn-success">Create Recommended Activity</button>
        </form>
    </div>
@endsection

@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <!-- cutom Css Quill-->
    <link href="{{ URL::asset('build/css/quill-custom.css') }}"  rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });
        quill.on('text-change', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });
    </script>
@endpush
