@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit University Details</h1>
        <form action="{{ route('eductional.programs.details.update', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- This is important for PUT requests -->
            

            <div class="form-group">
                <label for="eduction_programs_id">University</label>
                <select name="eduction_programs_id" id="eduction_programs_id" class="form-control" required>
                    <option value="">Select University</option>
                    @foreach ($programList as $list)
                        <option value="{{ $list->id }}" 
                            {{ $program->eduction_programs_id == $list->id ? 'selected' : '' }}>
                            {{ $list->title }}
                        </option>
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

            <div class="form-group mb-3">
            <label for="financial_aid">Financial Aid</label>
            <div id="financialQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="financial_aid" name="financial_aid" required>{{ old('financial_aid', $program->financial_aid) }}</textarea>
                @error('financial_aid')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
            <label for="campus">Campus</label>
            <div id="campusQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="campus" name="campus" required>{{ old('campus', $program->campus) }}</textarea>
                @error('campus')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="label">Faculties</label>
                <textarea class="form-control" id="faculties" name="faculties"  rows="8" cols="50" required>{{ old('faculties', $program->faculties) }}</textarea>
            </div>

            <div class="form-group mb-3">
            <label for="additional_program">Additional Program</label>
            <div id="additionalProgramQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="additional_program" name="additional_program" required>{{ old('additional_program', $program->additional_program) }}</textarea>
                @error('additional_program')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
            <label for="research">Research</label>
            <div id="researchQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="research" name="research" required>{{ old('research', $program->research) }}</textarea>
                @error('research')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
          
            <div class="form-group mb-3">
            <label for="student_life">Student Life</label>
            <div id="studentLifeQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="student_life" name="student_life" required>{{ old('student_life', $program->student_life) }}</textarea>
                @error('research')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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
        aboutQuill.root.style.minHeight = '150px';

        // Your content in HTML format (retrieved from the backend)
        let savedContent = `{!! old('about', $program->about) !!}`;
        // Load the saved content into the editor
        aboutQuill.clipboard.dangerouslyPasteHTML(savedContent);
        aboutQuill.on('text-change', function() {
            document.querySelector('#about').value = aboutQuill.root.innerHTML;
        });

        var financialQuill = new Quill('#financialQuill', {
            theme: 'snow'
        });
        financialQuill.root.style.minHeight = '150px';

        let savedContent1 = `{!! old('financial_aid', $program->financial_aid) !!}`;
        financialQuill.clipboard.dangerouslyPasteHTML(savedContent);
        financialQuill.on('text-change', function() {
            document.querySelector('#financial_aid').value = financialQuill.root.innerHTML;
        });

        var campusQuill = new Quill('#campusQuill', {
            theme: 'snow'
        });
        campusQuill.root.style.minHeight = '150px';

        let savedContent2 = `{!! old('campus', $program->campus) !!}`;
        campusQuill.clipboard.dangerouslyPasteHTML(savedContent);
        campusQuill.on('text-change', function() {
            document.querySelector('#campus').value = campusQuill.root.innerHTML;
        });

        var additionalProgramQuill = new Quill('#additionalProgramQuill', {
            theme: 'snow'
        });
        additionalProgramQuill.root.style.minHeight = '150px';

        let savedContent3 = `{!! old('additional_program', $program->additional_program) !!}`;
        additionalProgramQuill.clipboard.dangerouslyPasteHTML(savedContent);
        additionalProgramQuill.on('text-change', function() {
            document.querySelector('#campus').value = additionalProgramQuill.root.innerHTML;
        });

        var researchQuill = new Quill('#researchQuill', {
            theme: 'snow'
        });
        researchQuill.root.style.minHeight = '150px';

        let savedContent4 = `{!! old('research', $program->research) !!}`;
        researchQuill.clipboard.dangerouslyPasteHTML(savedContent);
        researchQuill.on('text-change', function() {
            document.querySelector('#campus').value = researchQuill.root.innerHTML;
        });

        var studentLifeQuill = new Quill('#studentLifeQuill', {
            theme: 'snow'
        });
        studentLifeQuill.root.style.minHeight = '150px';

        let savedContent5 = `{!! old('student_life', $program->student_life) !!}`;
        studentLifeQuill.clipboard.dangerouslyPasteHTML(savedContent);
        studentLifeQuill.on('text-change', function() {
            document.querySelector('#student_life').value = studentLifeQuill.root.innerHTML;
        });
    </script>
@endpush 