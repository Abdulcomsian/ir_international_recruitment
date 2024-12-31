@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Agora Event</h1>
        <form action="{{ route('activities.agora-events.update', $agoraEvent->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($agoraEvent->image_path)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ $agoraEvent->image_path }}" alt="Current Image" class="img-size-1" />
                </div>
            @endif

            <div class="form-group">
                <label for="Image">Image</label>
                <input type="file" class="form-control" id="image" name="img" />
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $agoraEvent->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price"
                    value="{{ old('price', $agoraEvent->price) }}" required />
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hostedBy">Hosted By</label>
                <input type="text" class="form-control" id="hostedBy" name="hosted_by"
                    value="{{ old('hosted_by', $agoraEvent->hosted_by) }}" required />
                @error('hosted_by')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $agoraEvent->address) }}" required />
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Agora Event</button>
        </form>
    </div>
@endsection
