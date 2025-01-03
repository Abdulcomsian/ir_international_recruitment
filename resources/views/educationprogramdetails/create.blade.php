@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create University</h1>
        <form action="{{ route('eductional.programs.details.store') }}" method="POST" enctype="multipart/form-data">
            @csrf   

            <div class="form-group">
                <label for="university_id">University</label>
                <select name="eduction_programs_id" id="eduction_programs_id" class="form-control" required>
                    <option value="">Select University</option>
                    @foreach ($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="form-group mb-3">
                <label for="about">About</label>
                <div id="aboutQuill" class="bg-white"></div>
                <textarea class="form-control d-none" id="about" name="about" required></textarea>
                @error('about')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="financial_aid">Financial Aid</label>
                <div id="financial-aid-quill" class="bg-white"></div>
                <textarea class="form-control d-none" id="financial_aid" name="financial_aid" required></textarea>
                @error('financial_aid')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="campus">Campus</label>
                <div id="campus-quill" class="bg-white"></div>
                <textarea class="form-control d-none" id="campus" name="campus" required></textarea>
                @error('campus')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="faculties ">Faculties</label>
                <textarea class="form-control" id="faculties" name="faculties" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="additional_program">Additional Program</label>
                <div id="additional-program-quill" class="bg-white"></div>
                <textarea class="form-control d-none" id="additional_program" name="additional_program" required></textarea>
                @error('additional_program')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mb-3">
                <label for="research">Research</label>
                <div id="research-quill" class="bg-white"></div>
                <textarea class="form-control d-none" id="research" name="research" required></textarea>
                @error('research')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="student_life">Student Life</label>
                <div id="student-life-quill" class="bg-white"></div>
                <textarea class="form-control d-none" id="student_life" name="student_life" required></textarea>
                @error('student_life')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Create University Details</button>
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
        var studentLifeQuill = new Quill('#student-life-quill', {
            theme: 'snow'
        });
        studentLifeQuill.on('text-change', function() {
            document.querySelector('#student_life').value = studentLifeQuill.root.innerHTML;
        });

        var researchQuill = new Quill('#research-quill', {
            theme: 'snow'
        });
        researchQuill.on('text-change', function() {
            document.querySelector('#research').value = researchQuill.root.innerHTML;
        });

        var additionalProgramQuill = new Quill('#additional-program-quill', {
            theme: 'snow'
        });
        additionalProgramQuill.on('text-change', function() {
            document.querySelector('#additional_program').value = additionalProgramQuill.root.innerHTML;
        });

        var campusQuill = new Quill('#campus-quill', {
            theme: 'snow'
        });
        campusQuill.on('text-change', function() {
            document.querySelector('#campus').value = campusQuill.root.innerHTML;
        });

        var financialAidQuill = new Quill('#financial-aid-quill', {
            theme: 'snow'
        });
        financialAidQuill.on('text-change', function() {
            document.querySelector('#financial_aid').value = financialAidQuill.root.innerHTML;
        });

        var aboutQuill = new Quill('#aboutQuill', {
            theme: 'snow'
        });
        aboutQuill.on('text-change', function() {
            document.querySelector('#about').value = aboutQuill.root.innerHTML;
        });
    </script>
@endpush