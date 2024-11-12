@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Packing List ({{ $quebecClimatePackingList->quebecClimate->title ?? '' }})</h1>
        <form action="{{ route('quebec.climates.packing-list.update', ['id' => $quebecClimatePackingList->quebec_climate_id,'packing_list' => $quebecClimatePackingList->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($quebecClimatePackingList->image_path)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ $quebecClimatePackingList->image_path }}" alt="Current Image" class="img-size-1" />
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
                    value="{{ old('title', $quebecClimatePackingList->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">

                <label for="description">Description</label>
                <div id="quill-editor" class="bg-white"></div>
                <textarea class="form-control d-none" id="description" name="description" required>{{ old('description', $quebecClimatePackingList->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Packing List</button>
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
        let savedContent = `{!! old('description', $quebecClimatePackingList->description) !!}`;
        // Load the saved content into the editor
        quill.clipboard.dangerouslyPasteHTML(savedContent);
        quill.on('text-change', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });
    </script>
@endpush
