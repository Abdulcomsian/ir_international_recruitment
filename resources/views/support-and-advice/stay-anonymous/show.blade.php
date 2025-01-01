@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Stay Anonymous</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <label for="Image">Image</label><br />
                        @if ($stayAnonymous->img_proof)
                            <img src="{{ $stayAnonymous->image_proof_path }}" alt="Current Image" class="img-size-1" />
                        @else
                            <div>
                                -
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="address">Address</label>
                        <div>
                            {{ $stayAnonymous->address }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {{ $stayAnonymous->description }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="voiceMessage">Voice Message</label>
                        <div>
                            @if ($stayAnonymous->voice_msg)
                                <audio src="{{ $stayAnonymous->voice_msg_path }}" controls></audio>
                            @else
                            -
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{ route('support-and-advice.stay-anonymous.index') }}" class="btn btn-dark">Stay Anonymous</a>
    </div>
@endsection
