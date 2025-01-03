@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit University</h1>
        <form action="{{ route('eductional.programs.details.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->
            
            <div class="form-group">
                <label for="eduction_programs_id">University</label>
                <select name="eduction_programs_id" id="eduction_programs_id" class="form-control" required>
                    <option value="">Select University</option>
                    @foreach ($programList as $list)
                    <option value="{{ $program->id }}">{{ $list->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="label">Address</label>
                <input type="text" class="form-control" id="label" name="address" value="{{ old('address', $program->address) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="about">About</label>
                <div id="aboutQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="about" name="about" required>{{ old('about', $program->about) }}</textarea>
                @error('about')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="label">Financial Aid</label>
                <textarea class="form-control" id="financial_aid" name="financial_aid"  rows="4" cols="50" required>{{ old('financial_aid', $program->financial_aid) }}</textarea>
            </div>


            <div class="form-group">
                <label for="label">Campus</label>
                <textarea class="form-control" id="campus" name="campus"  rows="4" cols="50" required>{{ old('campus', $program->campus) }}</textarea>
            </div>

            <div class="form-group">
                <label for="label">Faculties</label>
                <textarea class="form-control" id="faculties" name="faculties"  rows="4" cols="50" required>{{ old('faculties', $program->faculties) }}</textarea>

            </div>

            <div class="form-group">
                <label for="label">Additional Program</label>
                <textarea class="form-control" id="additional_program" name="additional_program"  rows="4" cols="50" required>{{ old('additional_program', $program->additional_program) }}</textarea>

            </div>
            
            <div class="form-group">
                <label for="label">Research</label>
                <textarea class="form-control" id="research" name="research"  rows="4" cols="50" required>{{ old('research', $program->research) }}</textarea>

            </div>

            <div class="form-group">
                <label for="label">Student Life</label>
                <textarea class="form-control" id="student_life" name="student_life"  rows="4" cols="50" required>{{ old('student_life', $program->student_life) }}</textarea>

            </div>
          
            
            <button type="submit" class="btn btn-success">Update University Detail</button>
        </form>
    </div>
@endsection
@push('page-css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <!-- cutom Css Quill-->
    <link href="{{ URL::asset('build/css/quill-custom.css') }}"  rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        var aboutQuill = new Quill('#aboutQuill', {
            theme: 'snow'
        });
        // Your content in HTML format (retrieved from the backend)
        let savedContent = `{!! old('about', $program->about) !!}`;
        // Load the saved content into the editor
        aboutQuill.clipboard.dangerouslyPasteHTML(savedContent);
        aboutQuill.on('text-change', function() {
            document.querySelector('#about').value = aboutQuill.root.innerHTML;
        });
    </script>
@endpush