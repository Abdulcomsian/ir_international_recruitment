@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Validation Guide</h1>
        <form action="{{ route('diploma.validation.update', $diploma->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
            <label for="diploma_id">Diploma Field</label>
                <select name="diploma_id" id="diploma_id" class="form-control" required>
                    <option value="">Select a diploma</option>
                    @foreach ($fields as $field)
                    <option value="{{ $field->id }}" @selected($diploma->diploma_id == $field->id)>{{ $field->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
            <label for="validation_organization">organization</label>
            <input type="text" class="form-control" id="validation_organization" name="validation_organization" value="{{ old('title', $diploma->validation_organization) }}" required>
            </div>

            <div class="form-group">
            <label for="visit_website">Visit Website</label>
            <input type="text" class="form-control" id="visit_website" name="visit_website" value="{{old('visit_website',$diploma->visit_website)}}" required>
            </div>

            <div class="form-group">
            <label for="validation_guides">Validation Guides</label>
            <input type="text" class="form-control" id="validation_guides" name="validation_guides" value="{{old('validation_guides',$diploma->validation_guides)}}" required>
            </div>


            <button type="submit" class="btn btn-success">Update Validation Guide</button>
        </form>
    </div>
@endsection
