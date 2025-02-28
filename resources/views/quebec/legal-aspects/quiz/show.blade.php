@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>View Quebec Legal Aspect Quiz Category</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecLegalAspect->featured_image)
                            <label for="Image">Image</label><br />
                            <img src="{{ asset($quebecLegalAspect->featured_image) }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecLegalAspect->title }}


                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecLegalAspect->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.legal-aspects.quiz.index', ['id' => $id]) }}" class="btn btn-dark">Back to Quebec Legal Aspects Quizzes</a>

    </div>
@endsection
