@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create Quebec History</h1>
        <form action="{{ route('history-quebec.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Image">Featured Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
           
            
            <div class="form-group mb-3">
                <label for="blog">Blog</label>
                <div id="quill-editor" class="bg-white"></div>
                <textarea class="form-control d-none" id="blog" name="blog" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="btn btn-success">Create Quebec History</button>
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
            document.querySelector('#blog').value = quill.root.innerHTML;
        });
    </script>
@endpush
