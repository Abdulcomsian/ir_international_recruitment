@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create City Service</h1>
        <form action="{{ route('city-guide.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="keyword">Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="often_services">Often Services</option>
                    <option value="others">Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Create City Service</button>
        </form>
    </div>
@endsection
