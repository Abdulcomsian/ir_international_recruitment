@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Transportation</h1>
        <form action="{{ route('city-guide.transportations.update', $transportation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($transportation->image_path)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ $transportation->image_path }}" alt="Current Image" class="img-size-1" />
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
                <label for="city">City</label>
                <select name="city_id" id="cityId" class="form-control">
                    <option value="">Select</option>
                    @forelse ($cities as $city)
                        <option value="{{ $city->id }}" @selected($transportation->city_id == $city->id)>{{ $city->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('city_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $transportation->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $transportation->type) }}" required />
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="contactNo">Contact No.</label>
                <input type="text" class="form-control" id="contactNo" name="contact_no" value="{{ old('contact_no', $transportation->contact_no) }}" required />
                @error('contact_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="fromPrice">From Price</label>
                <input type="text" class="form-control" id="fromPrice" name="from_price" value="{{ old('from_price', $transportation->from_price) }}" />
                @error('from_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="toPrice">To Price</label>
                <input type="text" class="form-control" id="toPrice" name="to_price" value="{{ old('to_price', $transportation->to_price) }}" />
                @error('to_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="websiteUrl">Website URL</label>
                <input type="text" class="form-control" id="websiteUrl" name="website_url" value="{{ old('website_url', $transportation->website_url) }}" required />
                @error('website_url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="location">Location</label>
                <textarea class="form-control" id="location" name="location" required>{{ old('location', $transportation->location) }}</textarea>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $transportation->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Transportation</button>
        </form>
    </div>
@endsection
