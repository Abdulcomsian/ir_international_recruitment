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
                <input type="text" class="form-control" id="price" name="price" required />
                @error('price')
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
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required />
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Create Agora Event</button>
        </form>
    </div>
@endsection
