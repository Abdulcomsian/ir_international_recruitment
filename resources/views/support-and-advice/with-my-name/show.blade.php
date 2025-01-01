@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View With My Name</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        <label for="Image">Image</label><br />
                        @if ($withMyName->img_proof)
                            <img src="{{ $withMyName->image_proof_path }}" alt="Current Image" class="img-size-1" />
                        @else
                            <div>
                                -
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="name">Name</label>
                        <div>
                            {{ $withMyName->name }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="phoneNo">Phone Number</label>
                        <div>
                            {{ $withMyName->contact_no }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="address">Address</label>
                        <div>
                            {{ $withMyName->address }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {{ $withMyName->description }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="voiceMessage">Voice Message</label>
                        <div>
                            @if ($withMyName->voice_msg)
                                <audio src="{{ $withMyName->voice_msg_path }}" controls></audio>
                            @else
                            -
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <a href="{{ route('support-and-advice.with-my-name.index') }}" class="btn btn-dark">With My Name</a>
    </div>
@endsection
