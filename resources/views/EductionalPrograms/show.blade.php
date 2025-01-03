@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View University</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($program->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $program->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="name">Name</label>
                        <div>
                            {{ $program->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="type">University Type</label>
                        <div>
                            {{ ucfirst($program->university_type) }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="city">City</label>
                        <div>
                            {{ $program->city->name ?? '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('eductional.programs.index') }}" class="btn btn-dark">Unviversties List</a>
    </div>
@endsection
