@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New Legal Aid</h1>
        <form action="{{ route('quebec.legal-aspects.legal-aids.store', $quebecLegalAspect->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="Image">Image</label>
                <input type="file" class="form-control" id="image" name="img" required />
                @error('img')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <select name="city_id" id="cityId" class="form-control">
                    <option value="">Select</option>
                    @forelse ($cities as $city)
                        <option value="{{ $city->id }}" >{{ $city->name }}</option>
                    @empty
                    @endforelse
                </select>
                @error('city_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required />
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phoneNo">Phone No.</label>
                <input type="text" class="form-control" id="phoneNo" name="phone_no" required />
                @error('phone_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Create Legal Aid</button>
        </form>
    </div>
@endsection
