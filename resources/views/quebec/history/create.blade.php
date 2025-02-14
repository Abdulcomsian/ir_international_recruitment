@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Quebec Information- Create Quebec History</h2>

    <form action="{{ route('history-quebec.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Featured Image -->
        <div class="form-group">
            <label for="image">Featured Image</label>
            <input type="file" class="form-control" id="image" name="featured_image" required />
            @error('featured_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Category Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Sections -->
        <h4>Sections</h4>
        <div id="sections-container">
            <div class="section-group">
                <div class="quill-editor mb-2" style="height: 100px;"></div>
                <input type="hidden" name="sections[]" class="section-content">
                <button type="button" class="btn btn-danger remove-section" onclick="removeSection(this)">Remove</button>
            </div>
        </div>

        <button type="button" class="btn btn-success mt-2" onclick="addSection()">Add Section</button>

        <br><br>
        <button type="submit" class="btn btn-primary">Save Category</button>
    </form>
</div>

<!-- Include Quill JS & CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
        document.addEventListener("DOMContentLoaded", function () {
        initializeQuillEditors(); // Initialize existing Quill editors
    });

    function initializeQuillEditors() {
        document.querySelectorAll('.quill-editor').forEach((editor) => {
            if (!editor.classList.contains("ql-container")) { // Prevent multiple initialization
                let quill = new Quill(editor, {
                    theme: 'snow',
                    placeholder: 'Enter section content...',
                    modules: { toolbar: true }
                });

                let hiddenInput = editor.nextElementSibling; // Hidden input for storing HTML content

                quill.on('text-change', function () {
                    hiddenInput.value = quill.root.innerHTML;
                });

                editor.dataset.quillInitialized = "true"; // Mark as initialized
            }
        });
    }

    function addSection() {
        let container = document.getElementById('sections-container');
        let div = document.createElement('div');
        div.classList.add('section-group');

        div.innerHTML = `
            <div class="quill-editor mb-2"></div>
            <input type="hidden" name="sections[]" class="section-content">
            <button type="button" class="btn btn-danger remove-section" onclick="removeSection(this)">Remove</button>
        `;

        container.appendChild(div);
        
        let newEditor = div.querySelector('.quill-editor');
        let newHiddenInput = div.querySelector('.section-content');

        // Initialize only the newly added Quill editor
        let quill = new Quill(newEditor, {
            theme: 'snow',
            placeholder: 'Enter section content...',
            modules: { toolbar: true }
        });

        quill.on('text-change', function () {
            newHiddenInput.value = quill.root.innerHTML;
        });
    }

    function removeSection(button) {
        button.parentElement.remove();
    }

</script>
@endsection
