@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Manage Culture Quiz Overview</h2>

    <div class="card mb-4">
        <div class="card-body">
        <label for="Image">Background Image</label><br />
        <img src="{{ asset('storage/' . $overview->featured_image) }}" alt="Featured Image" class="img-fluid mb-3" style="height: 50px; width:50px;">

        <div class="col-sm-12">
            <label for="title">Title</label>
            <div>
                {{$overview->title_question  }}
            </div>
        </div>
<br>
        <div class="col-sm-12">
            <label for="description">Description</label>
            <div>
                {!! nl2br($overview->description) !!}
            </div>
        </div>
        
    </div>

    <div class="card mb-4" style="margin-left:20px;">
    <label for="title">Labels</label>
        @foreach($overview->labels as $label)
            <div class="card-body">
                        <p class="card-title">{{ $label->label ?? '' }}</p>
                    </div>
            <div class="col-md-4 mb-3" style="height: 50px; width:50px;">
                <div class="card">
                    <img src="{{ asset('storage/' . $label->label_image) }}" alt="Label Image" class="card-img-top">
                    
                </div>
            </div>
        @endforeach
    </div>
    </div>
    <a href="{{ route('culture.quiz.overview.index', ['id' => $quizID]) }}" class="btn btn-dark">Manage Culture Quiz OverView List</a>

</div>
@endsection
