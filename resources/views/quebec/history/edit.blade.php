@extends('layouts.main')

@section('content')
<div class="container">
<h2>Quebec Information- Edit Quebec History</h2>

    <form action="{{ route('history-quebec.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" name="featured_image" class="form-control">
            @if($category->featured_image)
                <p>Current Image:</p>
                <img src="{{ asset($category->featured_image) }}" width="150">
            @endif
        </div>
        
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}" required>
        </div>

        

        <div class="mb-3">
            <label class="form-label">Sections</label>
            <div id="sections-container">
                @foreach($category->sections as $section)
                    <div class="section-group">
                        <div class="quill-editor" data-content="{{ $section->content }}"></div>
                        <input type="hidden" name="sections[]" value="{{ $section->content }}">
                        <button type="button" class="btn btn-danger mt-2 remove-section">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-success mt-2" id="add-section">Add Section</button>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

<!-- Include Quill JS and CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    initializeQuillEditors(); // Initialize existing Quill editors on page load
});

// Function to initialize Quill only for new editors
function initializeQuillEditors() {
    document.querySelectorAll('.quill-editor:not([data-initialized])').forEach(function (editor) {
        let quill = new Quill(editor, {
            theme: 'snow',
            placeholder: 'Enter section content...',
            modules: { toolbar: true }
        });

        // Get initial content from data-content attribute (for editing existing sections)
        let content = editor.getAttribute('data-content') || "";
        quill.root.innerHTML = content;

        // Update hidden input field when content changes
        let hiddenInput = editor.nextElementSibling;
        quill.on('text-change', function () {
            hiddenInput.value = quill.root.innerHTML;
        });

        // Mark this editor as initialized to prevent duplicates
        editor.setAttribute('data-initialized', 'true');
    });
}

// Add new Quill editor dynamically
document.getElementById('add-section').addEventListener('click', function() {
    let container = document.getElementById('sections-container');
    let div = document.createElement('div');
    div.classList.add('section-group');
    div.innerHTML = `
        <div class="quill-editor"></div>
        <input type="hidden" name="sections[]">
        <button type="button" class="btn btn-danger mt-2 remove-section">Remove</button>
    `;
    container.appendChild(div);

    initializeQuillEditors();  // Only initialize newly added editor
});

// Remove section
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-section')) {
        event.target.parentElement.remove();
    }
});

</script>
@endsection
