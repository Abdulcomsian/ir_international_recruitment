@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit City</h1>
        <form action="{{ route('cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">City</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $city->name) }}" required />
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success mt-2">Update City</button>
        </form>
    </div>
@endsection
