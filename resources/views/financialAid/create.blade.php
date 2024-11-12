@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Financial Aid</h1>
        <form action="{{ route('financial.aid.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf   

            <div class="form-group">
                <label for="university_id">Select Program</label>
                <select name="program_id" id="program_id" class="form-control" required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="title">Link</label>
                <input type="text" class="form-control" id="link" name="link" required>
            </div>

            <div class="form-group">
                <label for="title">featured_image</label>
                <input type="file" class="form-control" id="image" name="featured_image" required>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Create FinancialAid</button>
        </form>
    </div>
@endsection
