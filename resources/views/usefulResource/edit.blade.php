@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit JobSearch</h1>
        <form action="{{ route('diploma.resource.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
            <label for="diploma_id">Diploma Field</label>
                <select name="diploma_id" id="diploma_id" class="form-control" required>
                    <option value="">Select a diploma</option>
                    @foreach ($fields as $field)
                    <option value="{{ $field->id }}">{{ $field->title }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
            <label for="visit_website">Visit Website</label>
            <input type="text" class="form-control" id="visit_website" name="visit_website" value="{{old('visit_website',$resource->visit_website)}}" required>
            </div>

            <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title',$resource->title)}}" required>
            </div>

            
            <button type="submit" class="btn btn-success">Update Resource</button>
        </form>
    </div>
@endsection
