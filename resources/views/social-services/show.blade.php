@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Social Service Legal Aid</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($socialServiceLegalAid->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $socialServiceLegalAid->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="city">City</label>
                        <div>
                            {{ $socialServiceLegalAid->city->name ?? '' }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $socialServiceLegalAid->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="email">Email</label>
                        <div>
                            {{ $socialServiceLegalAid->email }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="phone_no">Phone No.</label>
                        <div>
                            {{ $socialServiceLegalAid->phone_no }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="address">Address</label>
                        <div>
                            {!! nl2br($socialServiceLegalAid->address) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('social-services.index') }}" class="btn btn-dark">Social Service Legal Aids List</a>
    </div>
@endsection
