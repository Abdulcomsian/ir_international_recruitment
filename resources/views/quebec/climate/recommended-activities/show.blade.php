@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Recommended Activity</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecClimateRecommendedActivity->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $quebecClimateRecommendedActivity->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="Type">Type</label>
                        <div>
                            {{ $quebecClimateRecommendedActivity->type }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecClimateRecommendedActivity->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecClimateRecommendedActivity->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.climates.recommended-activities.index',$quebecClimateRecommendedActivity->quebec_climate_id) }}" class="btn btn-dark">Quebec Climate Recommended Activities</a>
    </div>
@endsection
