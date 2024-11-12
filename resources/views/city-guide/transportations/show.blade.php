@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Transportation</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($transportation->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $transportation->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="city">City</label>
                        <div>
                            {{ $transportation->city->name ?? '' }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $transportation->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="type">Type</label>
                        <div>
                            {{ $transportation->type }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="contactNo">Contact No.</label>
                        <div>
                            {{ $transportation->contact_no }}
                        </div>
                    </div>
                    @if (empty($transportation->from_price) && empty($transportation->to_price))
                    <div class="col-sm-12">
                        <label for="price">Price </label>
                        <div>
                            {{ __('Variable Cost') }}
                        </div>
                    </div>
                    @else
                    <div class="col-sm-12">
                        <label for="fromPrice">From Price </label>
                        <div>
                            {{ $transportation->from_price }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="toPrice">To Price</label>
                        <div>
                            {{ $transportation->to_price }}
                        </div>
                    </div>

                    @endif
                    <div class="col-sm-12">
                        <label for="websiteUrl">Website URL</label>
                        <div>
                            {{ $transportation->website_url }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="location">Location</label>
                        <div>
                            {!! nl2br($transportation->location) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($transportation->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('city-guide.transportations.index') }}" class="btn btn-dark">Transportations List</a>
    </div>
@endsection
