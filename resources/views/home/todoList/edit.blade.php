@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit To do list</h1>
        <form action="{{ route('toDoList.update', $list->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($list->featured_image)
                <div class="form-group">
                    <label>Current Featured Image</label><br>
                    <img src="{{ asset("$list->featured_image") }}" alt="Current Featured Image" style="width: 150px; height: auto;">
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="blog">Blog</label>
                <div id="quill-editor" class="bg-white"></div>
                <textarea class="form-control d-none" id="blog" name="blog" required>{{ old('blog', $list->blog) }}</textarea>
                @error('blog')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="pending" @selected($list->status === 'pending')>Pending</option>
                    <option value="completed" @selected($list->status === 'completed')>Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update to do list</button>
        </form>
    </div>
@endsection


@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <!-- cutom Css Quill-->
    <link href="{{ URL::asset('build/css/quill-custom.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });
        // Your content in HTML format (retrieved from the backend)
        let savedContent = `{!! old('blog', $list->blog) !!}`;
        // Load the saved content into the editor
        quill.clipboard.dangerouslyPasteHTML(savedContent);
        quill.on('text-change', function() {
            document.querySelector('#blog').value = quill.root.innerHTML;
        });
    </script>
@endpush

