@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Quebec Food</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecFood->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $quebecFood->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecFood->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecFood->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.foods.index') }}" class="btn btn-dark">Quebec Food List</a>
    </div>
@endsection
