@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Quebec History</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($historyQuebec->featured_image)
                            <label for="Image">Image</label><br />
                            <img src="{{ asset($historyQuebec->featured_image) }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            <!-- {{$quebecHistoryCategory->id}}s -->
                            {{ $historyQuebec->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Sections</label>
                        <div>
                            @foreach($historyQuebec->sections as $section)
                                <div>
                                <strong>Section {{ $loop->iteration }}:</strong> 
                                {!! nl2br($section->content) !!} <!-- Display the content of each section -->
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{ route('quebec-history-categories.history-quebec.index', $quebecHistoryCategory->id) }}" class="btn btn-dark">Quebec History</a>

    </div>
@endsection
