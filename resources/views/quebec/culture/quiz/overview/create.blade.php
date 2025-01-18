@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create  Culture Quiz Overview</h1>
        <form action="{{ route('culture.quiz.overview.store',['quizId' => $quiz->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Featured Image Field -->
            <div class="form-group">
                <label for="image">Background Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required />
                @error('featured_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Title Field -->
            <div class="form-group">
                <label for="title_question">Title</label>
                <input type="text" class="form-control" id="title_question" name="title_question" required />
                @error('title_question')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="description">Description</label>
                <!-- Quill Editor -->
                <div id="quill-editor" style="height: 200px;"></div>
                <!-- Hidden Input for Description -->
                <input type="hidden" id="description" name="description">
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Labels and Label Images Section -->
           <!-- Labels and Label Images Section -->
<div id="label-section">
    <label>Labels & Label Images</label>
    <div class="label-item">
        <div class="form-group">
            <label for="label">Label</label>
            <input type="text" class="form-control" name="labels[]" placeholder="Enter Label" required />
        </div>
        <div class="form-group">
            <label for="label_image">Label Image</label>
            <input type="file" class="form-control" name="label_images[]" required />
        </div>
    </div>
</div>

<!-- Add More Labels Button -->
<div class="form-group">
    <button type="button" id="add-label-btn" class="btn btn-secondary">Add Another Label</button>
</div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Create Culture Quiz overview</button>
        </form>
    </div>
@endsection

@push('page-css')
    <!-- Quill CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link href="{{ URL::asset('build/css/quill-custom.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <!-- Quill JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        // Initialize Quill Editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });

        // Sync Quill Content with Hidden Input Field
        quill.on('text-change', function() {
            document.querySelector('#description').value = quill.root.innerHTML;
        });

        // Add More Labels Logic
        const labelSection = document.getElementById('label-section');
        const addLabelBtn = document.getElementById('add-label-btn');

        addLabelBtn.addEventListener('click', function() {
            const labelItem = document.createElement('div');
            labelItem.classList.add('label-item');
            labelItem.innerHTML = `
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" class="form-control" name="labels[]" placeholder="Enter Label" required />
                </div>
                <div class="form-group">
                    <label for="label_image">Label Image</label>
                    <input type="file" class="form-control" name="label_images[]" required />
                </div>
            `;
            labelSection.appendChild(labelItem);
        });
    </script>
@endpush
