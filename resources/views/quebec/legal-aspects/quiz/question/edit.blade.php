<!-- resources/views/quebec/culture/quiz/edit-question.blade.php -->
@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Legal Aspect Quiz Question</h1>

        <form action="{{ route('quebec.legal-aspects.quiz.question.update', ['id' => $id, 'overview' => $question->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image">
                @if ($question->featured_image)
                    <div class="mt-2">
                        <img src="{{ asset($question->featured_image) }}" alt="Featured Image" width="100">
                    </div>
                @endif
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="question_text">Question</label>
                <input type="text" name="question_text" id="question_text" class="form-control @error('question_text') is-invalid @enderror" value="{{ old('question_text', $question->question_text) }}" required>
                @error('question_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="question_type">Question Type</label>
                <select name="question_type" id="question_type" class="form-control @error('question_type') is-invalid @enderror" required>
                    <option value="simple" {{ old('question_type', $question->question_type) == 'simple' ? 'selected' : '' }}>Simple</option>
                    <option value="true/false" {{ old('question_type', $question->question_type) == 'true/false' ? 'selected' : '' }}>True/False</option>
                </select>
                @error('question_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="options">Options</label>
                <div id="options-container">
                    @foreach($question->getoptions as $index => $option)
                        <div class="option-item d-flex align-items-center mb-2">
                            <input type="text" name="options[]" class="form-control" value="{{ old('options.'.$index, $option->answer_text) }}" required>
                            <button type="button" class="btn btn-danger btn-sm ml-2 remove-option">Delete</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-option" class="btn btn-secondary mt-2">Add Option</button>
            </div>

            <div class="form-group">
                <label for="correct_option">Correct Option</label>
                <select name="correct_option" id="correct_option" class="form-control" required>
                    <option value="">Select Correct Option</option>
                    @foreach($question->getoptions as $index => $option)
                        <option value="{{ $index }}" {{ old('correct_option', $question->getoptions->where('is_correct', true)->first()->id) == $index ? 'selected' : '' }}>
                            Option {{ $index + 1 }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Question</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const optionsContainer = document.getElementById('options-container');
            const addOptionButton = document.getElementById('add-option');
            const correctOptionSelect = document.getElementById('correct_option');

            // Add new option input field
            addOptionButton.addEventListener('click', function () {
                const newOption = document.createElement('div');
                newOption.classList.add('option-item', 'd-flex', 'align-items-center', 'mb-2');
                newOption.innerHTML = `
                    <input type="text" name="options[]" class="form-control" placeholder="Option" required>
                    <button type="button" class="btn btn-danger btn-sm ml-2 remove-option">Delete</button>
                `;
                optionsContainer.appendChild(newOption);
                updateCorrectOptionOptions();
            });

            // Remove an option and update the correct option select list
            optionsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-option')) {
                    const optionItem = e.target.closest('.option-item');
                    optionItem.remove();
                    updateCorrectOptionOptions();
                }
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
