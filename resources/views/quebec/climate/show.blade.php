@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Quebec Climate</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecClimate->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $quebecClimate->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecClimate->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecClimate->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.climates.index') }}" class="btn btn-dark">Quebec Climate List</a>
    </div>
@endsection
