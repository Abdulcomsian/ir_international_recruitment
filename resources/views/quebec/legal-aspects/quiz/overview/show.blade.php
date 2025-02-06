@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Quiz Overview</h1>

        <!-- Featured Image -->
        <div class="mb-4">
            <h3>Featured Image</h3>
            @if($quiz->featured_image)
                <img src="{{ asset($quiz->featured_image) }}" alt="Featured Image" class="img-fluid">
            @else
                <p>No featured image available.</p>
            @endif
        </div>

        <!-- Title Question -->
        <div class="mb-4">
            <h3>Title Question</h3>
            <p>{{ $quiz->title_question }}</p>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <h3>Description</h3>
            <p>{{ $quiz->description }}</p>
            <p>{{ $id }}</p>
            <p>{{ $overview }}</p>

        </div>

        <!-- Labels and Label Images -->
        <div class="mb-4">
            <h3>Labels & Label Images</h3>
            @if($quiz->getoverviewLabels->count())
                <ul class="list-unstyled">
                    @foreach($quiz->getoverviewLabels as $label)
                        <li class="mb-3">
                            <strong>Label:</strong> {{ $label->label }} <br>
                            <strong>Label Image:</strong> 
                            <img src="{{ asset('storage/' . $label->label_image) }}" alt="Label Image" class="img-fluid mt-2" style="max-width: 200px;">
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No labels available.</p>
            @endif
        </div>

        <!-- Back Button -->
        <a href="{{ route('quebec.legal-aspects.quiz.overview.index', ['id' => $id, 'overview' => $overview]) }}" class="btn btn-primary">Back to Overview List</a>

        </div>
@endsection
