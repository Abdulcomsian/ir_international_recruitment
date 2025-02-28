@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Quebec Climate Seasonal ({{ $quebecClimate->title }} )</h1>
        <form action="{{ route('quebec.climates.seasonal.update', $quebecClimate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $quebecClimate->seasonal->title ?? '') }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="durationFrom">Duration From</label>
                <select name="duration_from" id="durationFrom" class="form-control">
                    <option value="">Select</option>
                    @forelse ($months as $month)
                        <option value="{{ $month }}" @selected($quebecClimate->seasonal && $month == $quebecClimate->seasonal->duration_from)>{{ $month }}</option>
                    @empty
                    @endforelse
                </select>
                @error('duration_from')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="durationTo">Duration To</label>
                <select name="duration_to" id="durationTo" class="form-control">
                    <option value="">Select</option>
                    @forelse ($months as $month)
                        <option value="{{ $month }}" @selected($quebecClimate->seasonal && $month == $quebecClimate->seasonal->duration_to)>{{ $month }}</option>
                    @empty
                    @endforelse
                </select>
                @error('duration_to')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">

                <label for="description">Description</label>
                <div id="quill-editor" class="bg-white"></div>
                <textarea class="form-control d-none" id="description" name="description" required>{{ old('description', $quebecClimate->seasonal->description ?? '') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Seasonal</button>
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
        let savedContent = `{!! old('description', $quebecClimate->seasonal->description ?? '') !!}`;
        // Load the saved content into the editor
        quill.clipboard.dangerouslyPasteHTML(savedContent);
        quill.on('text-change', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });
    </script>
@endpush
