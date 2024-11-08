@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Packing List</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecClimatePackingList->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $quebecClimatePackingList->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecClimatePackingList->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecClimatePackingList->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.climates.packing-list.index',$quebecClimatePackingList->quebec_climate_id) }}" class="btn btn-dark">Quebec Climate Packing List</a>
    </div>
@endsection
