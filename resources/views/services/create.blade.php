@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create New Service</h1>
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Service Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="image">Service Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-success">Create Service</button>
        </form>
    </div>
@endsection
