@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create Validation Guide</h1>
    <form action="{{ route('diploma.validation.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>


        <div class="form-group">
            <label for="diploma_id">Diploma</label>
            <select name="diploma_id" id="diploma_id" class="form-control" required>
                <option value="">Select a diploma</option>
                @foreach ($diplomas as $diploma)
                <option value="{{ $diploma->id }}">{{ $diploma->title }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="validation_organization">organization</label>
            <input type="text" class="form-control" id="validation_organization" name="validation_organization" required>
        </div>

        <div class="form-group">
            <label for="visit_website">Visit Website</label>
            <input type="text" class="form-control" id="visit_website" name="visit_website" required>
        </div>

        <div class="form-group">
            <label for="validation_guides">Validation Guides</label>
            <input type="text" class="form-control" id="validation_guides" name="validation_guides" required>
        </div>

        <br>
        <button type="submit" class="btn btn-success">Create JobSearch</button>
    </form>
</div>
@endsection