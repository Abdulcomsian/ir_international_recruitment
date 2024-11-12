@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Financial Aid</h1>
        <form action="{{ route('financial.aid.programs.update', $aid->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 

            <div class="form-group">
                <label for="program_id">Select Program</label>
                <select name="program_id" id="program_id" class="form-control" required>
                    <option value="">Select Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" 
                            {{ (old('program_id') == $program->id || (isset($aid) && $aid->program_id == $program->id)) ? 'selected' : '' }}>
                            {{ $program->title }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $aid->title) }}" required>
            </div>

            <div class="form-group">
                <label for="label">Label</label>
                <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $aid->link) }}" required>
            </div>
            
            <div class="form-group">
                <label for="image"> Image</label>
                <input type="file" class="form-control" id="image" name="featured_image">
                <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
            </div>

            @if($aid->featured_image)
                <div class="form-group">
                    <label>Current Image</label><br>
                    <img src="{{ asset($aid->featured_image) }}" alt="Current Image" style="width: 150px; height: auto;">
                </div>
            @endif
            
            <br>
            <button type="submit" class="btn btn-success">Update FinancialAid</button>
        </form>
    </div>
@endsection
