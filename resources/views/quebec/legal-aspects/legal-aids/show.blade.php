@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Legal Aid</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecLegalAspectAid->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $quebecLegalAspectAid->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="city">City</label>
                        <div>
                            {{ $quebecLegalAspectAid->city->name ?? '' }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecLegalAspectAid->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="email">Email</label>
                        <div>
                            {{ $quebecLegalAspectAid->email }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="phone_no">Phone No.</label>
                        <div>
                            {{ $quebecLegalAspectAid->phone_no }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="address">Address</label>
                        <div>
                            {!! nl2br($quebecLegalAspectAid->address) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="address">Latitude</label>
                        <div>
                            {!! nl2br($quebecLegalAspectAid->latitude) !!}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="address">Longitude</label>
                        <div>
                            {!! nl2br($quebecLegalAspectAid->longitude) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.legal-aspects.legal-aids.index', $quebecLegalAspectAid->quebec_legal_aspect_id) }}" class="btn btn-dark">Quebec Legal Aids List</a>
    </div>
@endsection
