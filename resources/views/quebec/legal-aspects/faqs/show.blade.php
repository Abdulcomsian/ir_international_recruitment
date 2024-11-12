@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Faq</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $quebecLegalAspectFaq->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {!! nl2br($quebecLegalAspectFaq->description) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('quebec.legal-aspects.faqs.index',$quebecLegalAspectFaq->quebec_legal_aspect_id) }}" class="btn btn-dark">Quebec Legal Aspect Faqs</a>
    </div>
@endsection
