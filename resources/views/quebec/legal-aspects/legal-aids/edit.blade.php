@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Legal Aid</h1>
        <form action="{{ route('quebec.legal-aspects.legal-aids.update', ['id' => $quebecLegalAspectAid->quebec_legal_aspect_id, 'legal_aid' => $quebecLegalAspectAid->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($quebecLegalAspectAid->image_path)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ $quebecLegalAspectAid->image_path }}" alt="Current Image" class="img-size-1" />
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
                        <option value="{{ $city->id }}" @selected($quebecLegalAspectAid->city_id == $city->id)>{{ $city->name }}</option>
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
                    value="{{ old('title', $quebecLegalAspectAid->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $quebecLegalAspectAid->email) }}" required />
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phoneNo">Phone No.</label>
                <input type="text" class="form-control" id="phoneNo" name="phone_no" value="{{ old('phone_no', $quebecLegalAspectAid->phone_no) }}" required />
                @error('phone_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="address">address</label>
                <textarea class="form-control" id="address" name="address" required>{{ old('address', $quebecLegalAspectAid->address) }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude"
                    value="{{ old('latitude', $quebecLegalAspectAid->latitude) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude"
                    value="{{ old('longitude', $quebecLegalAspectAid->longitude) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Legal Aid</button>
        </form>
    </div>
@endsection
