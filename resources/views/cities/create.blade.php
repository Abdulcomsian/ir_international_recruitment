@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Create New City</h1>
        <form action="{{ route('cities.store') }}" method="POST" >
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-2">Create City</button>
        </form>
    </div>
@endsection
