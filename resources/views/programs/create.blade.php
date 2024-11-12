@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create New Program</h1>
        <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
           
            <br>
            <button type="submit" class="btn btn-success">Create Program</button>
        </form>
    </div>
@endsection
