@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create Quiz Category Overview</h1>
        <form action="{{ route('quebec.legal-aspects.quiz.overview.store', ['id' => $id, 'overview' => $overview]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" required />
                @error('featured_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title Question</label>
                <input type="text" class="form-control" id="title" name="title_question" required />
                @error('title_question')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required />
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

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

            <button type="submit" class="btn btn-success mt-2">Create Quiz Category Overview</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Add More Labels Logic
        document.addEventListener('DOMContentLoaded', function () {
            const labelSection = document.getElementById('label-section');
            const addLabelBtn = document.getElementById('add-label-btn');

            addLabelBtn.addEventListener('click', function () {
                // Create new label item
                const labelItem = document.createElement('div');
                labelItem.classList.add('label-item', 'mt-3'); // Added spacing for better UI
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
                // Append new label item to the label section
                labelSection.appendChild(labelItem);
            });
        });
    </script>
@endpush
