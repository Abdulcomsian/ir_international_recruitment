@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Financial Aid</h1>
        <form action="{{ route('programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $program->title) }}" required>
            </div>
          
            
            <button type="submit" class="btn btn-success">Update Financial Aid</button>
        </form>
    </div>
@endsection
