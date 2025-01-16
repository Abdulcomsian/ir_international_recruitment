@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Culture Quiz</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quiz->featured_image)
                            <label for="Image">Image</label><br />
                            <img src="{{ asset($quiz->featured_image) }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quiz->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quiz->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('culture.quiz.index') }}" class="btn btn-dark">Culture Quiz List</a>
    </div>
@endsection
