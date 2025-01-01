@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New Agora Event </h1>
        <form action="{{ route('activities.agora-events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="Image">Image</label>
                <input type="file" class="form-control" id="image" name="img" required />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="any" required />
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="event_datetime">Event DateTime</label>
                <input type="datetime-local" class="form-control" id="event_datetime" name="event_datetime" required />
                @error('event_datetime')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="hostedBy">Hosted By</label>
                <input type="text" class="form-control" id="hostedBy" name="hosted_by" required />
                @error('hosted_by')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="members">Members</label>
                <input type="number" class="form-control" id="members" name="members" step="any" required />
                @error('members')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" required />
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Create Agora Event</button>
        </form>
    </div>
@endsection
