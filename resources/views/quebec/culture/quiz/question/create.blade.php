<!-- resources/views/quebec/culture/quiz/create-question.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Add Question for Quiz: {{ $quiz->title }}</h1>

        <form action="{{ route('culture.quiz.questions.store', $quiz->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" required>
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="question_text">Question</label>
                <input type="text" name="question_text" id="question_text" class="form-control @error('question_text') is-invalid @enderror" value="{{ old('question_text') }}" required>
                @error('question_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="options">Options</label>
                <div id="options-container">
                    <div class="option-item">
                        <input type="text" name="options[]" class="form-control mb-2 @error('options.*') is-invalid @enderror" placeholder="Option 1" required>
                        @error('options.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror                    </div>
                    <div class="option-item">
                        <input type="text" name="options[]" class="form-control mb-2 @error('options.*') is-invalid @enderror" placeholder="Option 2" required>
                    </div>
                </div>
                @error('options')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <button type="button" id="add-option" class="btn btn-secondary mt-2">Add Option</button>
            </div>

            <div class="form-group">
                <label for="correct_option">Correct Option</label>
                <select name="correct_option" id="correct_option" class="form-control @error('correct_option') is-invalid @enderror" required>
                    <option value="">Select Correct Option</option>
                </select>
                @error('correct_option')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Question</button>
        </form>
    </div>
@endsection
@push('page-css')
    <!-- Quill CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <link href="{{ URL::asset('build/css/quill-custom.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script>
        // Add functionality for dynamically adding options and updating the correct option select list
        document.addEventListener('DOMContentLoaded', function () {
            const optionsContainer = document.getElementById('options-container');
            const addOptionButton = document.getElementById('add-option');
            const correctOptionSelect = document.getElementById('correct_option');

            // Add new option input field
            addOptionButton.addEventListener('click', function () {
                const newOption = document.createElement('div');
                newOption.classList.add('option-item');
                newOption.innerHTML = `<input type="text" name="options[]" class="form-control mb-2" placeholder="Option" required>`;
                optionsContainer.appendChild(newOption);
                updateCorrectOptionOptions();
            });

            // Update correct option select list based on the number of options
            function updateCorrectOptionOptions() {
                const options = optionsContainer.getElementsByClassName('option-item');
                correctOptionSelect.innerHTML = '<option value="">Select Correct Option</option>'; // Reset the select list

                Array.from(options).forEach((option, index) => {
                    const optionElement = document.createElement('option');
                    optionElement.value = index;
                    optionElement.textContent = `Option ${index + 1}`;
                    correctOptionSelect.appendChild(optionElement);
                });
            }

            updateCorrectOptionOptions(); // Call once on page load
        });
    </script>
@endpush
