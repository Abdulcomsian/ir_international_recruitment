@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Edit Culture Quiz Overview</h1>
        <form action="{{ route('culture.quiz.overview.update', $overview->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Featured Image Field -->
            <div class="form-group">
                <label for="image">Background Image</label>
                <input type="file" class="form-control" id="image" name="featured_image" />
                @if($overview->featured_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $overview->featured_image) }}" alt="Current Image" class="img-thumbnail" width="150">
                    </div>
                @endif
                @error('featured_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Title Field -->
            <div class="form-group">
                <label for="title_question">Title</label>
                <input type="text" class="form-control" id="title_question" name="title_question" value="{{ old('title_question', $overview->title_question) }}" required />
                @error('title_question')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="description">Description</label>
                <!-- Quill Editor -->
                <div id="quill-editor" style="height: 200px;">{!! old('description', $overview->description) !!}</div>
                <!-- Hidden Input for Description -->
                <input type="hidden" id="description" name="description" value="{{ old('description', $overview->description) }}">
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Labels and Label Images Section -->
            <div id="label-section">
                <label>Labels & Label Images</label>
                @foreach ($overview->labels as $index => $label)
                    <div class="label-item">
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" name="labels[]" value="{{ old('labels.' . $index, $label->label) }}" placeholder="Enter Label" required />
                        </div>
                        <div class="form-group">
                            <label for="label_image">Label Image</label>
                            <input type="file" class="form-control" name="label_images[]" />
                            @if($label->label_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $label->label_image) }}" alt="Label Image" class="img-thumbnail" width="100">
                                </div>
                            @endif
                        </div>
                        <!-- Checkbox to mark label for deletion -->
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="delete_label_ids[]" value="{{ $label->id }}" id="delete-label-{{ $label->id }}">
                            <label class="form-check-label text-danger" for="delete-label-{{ $label->id }}">Delete this Label</label>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Add More Labels Button -->
            <div class="form-group">
                <button type="button" id="add-label-btn" class="btn btn-secondary">Add Another Label</button>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">Update Culture Quiz Overview</button>
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
        // Initialize Quill Editor with Existing Content
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });
        quill.root.innerHTML = `{!! old('description', $overview->description) !!}`;

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
                    <input type="file" class="form-control" name="label_images[]" />
                </div>
            `;
            labelSection.appendChild(labelItem);
        });
    </script>
@endpush
