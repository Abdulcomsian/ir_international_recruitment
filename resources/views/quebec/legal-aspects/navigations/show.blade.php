@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Navigation</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($quebecLegalAspectNavigation->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $quebecLegalAspectNavigation->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecLegalAspectNavigation->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecLegalAspectNavigation->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.legal-aspects.navigations.index',$quebecLegalAspectNavigation->quebec_legal_aspect_id) }}" class="btn btn-dark">Quebec Legal Aspect Navigations</a>
    </div>
@endsection
