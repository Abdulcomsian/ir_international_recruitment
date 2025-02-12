@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New To Do List</h1>
        <form action="{{ route('toDoList.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Featured Image -->
            <div class="form-group mb-3">
                <label for="image">Featured Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required />
                @error('featured_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Blog Field -->
            <div class="form-group mb-3">
                <label for="blog">Blog</label>
                <div id="quill-editor" class="bg-white"></div>
                <textarea class="form-control d-none" id="blog" name="blog" required></textarea>
                @error('blog')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control  @error('status') is-invalid @enderror" required>
                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select Status</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Create To Do List</button>
        </form>
    </div>
@endsection

@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link href="{{ URL::asset('build/css/quill-custom.css') }}" rel="stylesheet" type="text/css" />
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
