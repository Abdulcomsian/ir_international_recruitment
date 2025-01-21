@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Show Culture Quiz Question</h2>

    <div class="card mb-4">
        <div class="card-body">
            <label for="Image">Featured Image</label><br />
            <img src="{{ asset( $question->featured_image) }}" alt="Featured Image" class="img-fluid mb-3" style="height: 50px; width:50px;">

            <div class="col-sm-12">
                <label for="title">Question Text</label>
                <div>
                    {{ $question->question_text }}
                </div>
            </div>
        </div>
    

    <div class="card mb-4" style="margin-left:20px;">
        <label for="options">Options</label>
        @foreach($question->options as $option)
            <div class="card-body">
                <p class="card-title">{{ $loop->iteration }}.{{ $option->answer_text ?? '' }}</p>
            </div>
        @endforeach
    </div>

    <div class="card mb-4" style="margin-left:20px;">
        <label for="">Correct Option</label>
        @php
            $correctOption = $question->options->firstWhere('is_correct', 1);
        @endphp
        @if($correctOption)
            <div class="card-body">
                <p class="card-title text-success">{{ $correctOption->answer_text }}</p>
            </div>
        @else
            <div class="card-body">
                <h5 class="card-title text-danger">No correct option defined.</h5>
            </div>
        @endif
    </div>
    </div>

    <a href="{{ route('culture.quiz.questions.index', ['id' => $quizID]) }}" class="btn btn-dark">Culture Quiz Question List</a>
</div>

@endsection
