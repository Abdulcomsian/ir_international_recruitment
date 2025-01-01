@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View Recommended Activity</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-4">
                        @if ($agoraEvent->image_path)
                            <label for="Image">Image</label><br />
                            <img src="{{ $agoraEvent->image_path }}" alt="Current Image" class="img-size-1" />
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <label for="title">Title</label>
                        <div>
                            {{ $agoraEvent->title }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="price">Price</label>
                        <div>
                            {{ $agoraEvent->price }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="price">Event DateTime</label>
                        <div>
                            {{ $agoraEvent->event_datetime }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="hostedBy">Hosted By</label>
                        <div>
                            {{ $agoraEvent->hosted_by }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="members">Members</label>
                        <div>
                            {{ $agoraEvent->members }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="location">Location</label>
                        <div>
                            {{ $agoraEvent->location }}
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="description">Description</label>
                        <div>
                            {{ $agoraEvent->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('activities.agora-events.index',$agoraEvent->id) }}" class="btn btn-dark">Agora Events</a>
    </div>
@endsection
