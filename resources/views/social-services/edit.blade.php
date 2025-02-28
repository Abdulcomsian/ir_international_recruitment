@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Social Service Legal Aid</h1>
        <form action="{{ route('social-services.update', $socialServiceLegalAid->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($socialServiceLegalAid->image_path)
                <div class="form-group">
                    <label>Image</label><br>
                    <img src="{{ $socialServiceLegalAid->image_path }}" alt="Current Image" class="img-size-1" />
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
                        <option value="{{ $city->id }}" @selected($socialServiceLegalAid->city_id == $city->id)>{{ $city->name }}</option>
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
                    value="{{ old('title', $socialServiceLegalAid->title) }}" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $socialServiceLegalAid->email) }}" required />
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phoneNo">Phone No.</label>
                <input type="text" class="form-control" id="phoneNo" name="phone_no" value="{{ old('phone_no', $socialServiceLegalAid->phone_no) }}" required />
                @error('phone_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="address">address</label>
                <textarea class="form-control" id="address" name="address" required>{{ old('address', $socialServiceLegalAid->address) }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Social Service Legal Aid</button>
        </form>
    </div>
@endsection
