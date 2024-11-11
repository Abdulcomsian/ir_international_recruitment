@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Useful Link</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecLegalAspectUsefulLink->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="link">Link</label>
                        <div>
                            {{ $quebecLegalAspectUsefulLink->link }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.legal-aspects.useful-links.index',$quebecLegalAspectUsefulLink->quebec_legal_aspect_id) }}" class="btn btn-dark">Quebec Legal Aspect Useful Links</a>
    </div>
@endsection
