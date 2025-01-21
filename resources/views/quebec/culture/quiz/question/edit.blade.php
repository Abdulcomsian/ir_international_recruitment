@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Quebec Culture Quiz Question</h1>

        <form action="{{ isset($question) ? route('culture.quiz.questions.update', [ $question->id]) : route('culture.quiz.questions.store', $quiz->id) }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf
            @if(isset($question))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" {{ !isset($question) ? 'required' : '' }}>
                @if(isset($question->featured_image))
                    <img src="{{ asset($question->featured_image) }}" alt="Current Image" class="img-thumbnail mt-2" width="150">
                @endif
                @error('featured_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="question_text">Question</label>
                <input type="text" name="question_text" id="question_text" class="form-control @error('question_text') is-invalid @enderror" 
                       value="{{ old('question_text', $question->question_text ?? '') }}" required>
                @error('question_text')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="options">Options</label>
                <div id="options-container">
                    @if(isset($question) && $question->options)
                        @foreach($question->options as $index => $option)
                            <div class="option-item d-flex align-items-center mb-2">
                                <input type="text" name="options[{{ $option['id'] }}][answer_text]" 
                                       class="form-control" 
                                       placeholder="Option {{ $index + 1 }}" 
                                       value="{{ $option['answer_text'] }}" 
                                       required>
                                <button type="button" class="btn btn-danger btn-sm ml-2 remove-option">Delete</button>
                            </div>
                        @endforeach
                    @else
                        <div class="option-item d-flex align-items-center mb-2">
                            <input type="text" name="options[new][]" class="form-control" placeholder="Option 1" required>
                            <button type="button" class="btn btn-danger btn-sm ml-2 remove-option">Delete</button>
                        </div>
                    @endif
                </div>
                <button type="button" id="add-option" class="btn btn-secondary mt-2">Add Option</button>
            </div>

            <div class="form-group">
                <label for="correct_option">Correct Option</label>
                <select name="correct_option" id="correct_option" class="form-control" required>
                    <option value="">Select Correct Option</option>
                    @if(isset($question) && $question->options)
                        @foreach($question->options as $index => $option)
                            <option value="{{ $option['id'] }}" {{ $option['is_correct'] ? 'selected' : '' }}>
                                Option {{ $index + 1 }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Quiz Question</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const optionsContainer = document.getElementById('options-container');
            const addOptionButton = document.getElementById('add-option');
            const correctOptionSelect = document.getElementById('correct_option');

            addOptionButton.addEventListener('click', function () {
                const newOption = document.createElement('div');
                newOption.classList.add('option-item', 'd-flex', 'align-items-center', 'mb-2');
                newOption.innerHTML = `
                    <input type="text" name="options[new][]" class="form-control" placeholder="Option" required>
                    <button type="button" class="btn btn-danger btn-sm ml-2 remove-option">Delete</button>
                `;
                optionsContainer.appendChild(newOption);
            });

            optionsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-option')) {
                    e.target.closest('.option-item').remove();
                }
            });
        });
    </script>
@endpush
