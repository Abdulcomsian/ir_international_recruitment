@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create University Details</h1>
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
                <label for="faculties">Faculties</label>
                <br>
                <button type="button" id="addTitleButton" class="btn btn-primary">Add</button>
                <div id="facultiesContainer"></div>
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
        studentLifeQuill.root.style.minHeight = '150px';

        studentLifeQuill.on('text-change', function() {
            document.querySelector('#student_life').value = studentLifeQuill.root.innerHTML;
        });

        var researchQuill = new Quill('#research-quill', {
            theme: 'snow'
        });
        researchQuill.root.style.minHeight = '150px';

        researchQuill.on('text-change', function() {
            document.querySelector('#research').value = researchQuill.root.innerHTML;
        });

        var additionalProgramQuill = new Quill('#additional-program-quill', {
            theme: 'snow'
        });
        additionalProgramQuill.root.style.minHeight = '150px';

        additionalProgramQuill.on('text-change', function() {
            document.querySelector('#additional_program').value = additionalProgramQuill.root.innerHTML;
        });

        var campusQuill = new Quill('#campus-quill', {
            theme: 'snow'
        });
        campusQuill.root.style.minHeight = '150px';

        campusQuill.on('text-change', function() {
            document.querySelector('#campus').value = campusQuill.root.innerHTML;
        });

        var financialAidQuill = new Quill('#financial-aid-quill', {
            theme: 'snow'
        });
        financialAidQuill.root.style.minHeight = '150px';

        financialAidQuill.on('text-change', function() {
            document.querySelector('#financial_aid').value = financialAidQuill.root.innerHTML;
        });

        var aboutQuill = new Quill('#aboutQuill', {
            theme: 'snow'
        });
        aboutQuill.root.style.minHeight = '150px';

        aboutQuill.on('text-change', function() {
            document.querySelector('#about').value = aboutQuill.root.innerHTML;
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addTitleButton = document.getElementById('addTitleButton');
            const facultiesContainer = document.getElementById('facultiesContainer');

            let titleIndex = 0; // Index to track titles and subheadings

            // Function to create a new title block with subheadings
            const createTitleBlock = () => {
                const titleBlock = document.createElement('div');
                titleBlock.classList.add('title-block', 'mb-3');
                titleBlock.dataset.index = titleIndex; // Set index for this title block

                // Title input
                titleBlock.innerHTML = `
                
                    <input type="text" name="titles[]" class="form-control mb-2" required>
                    <button type="button" class="btn btn-secondary addSubheadingButton">Add Program</button>
                    <div class="subheadings-container mt-2"></div>
                    <div class="d-flex justify-content-between align-items-center">
                        <label>Department</label>
                        <button type="button" class="btn btn-danger btn-sm removeTitleButton">Remove Department</button>
                    </div>
                `;

                // Add event listener to "Remove Department" button
                titleBlock.querySelector('.removeTitleButton').addEventListener('click', () => {
                    titleBlock.remove();
                });

                // Add event listener to "Add Subheading" button
                titleBlock.querySelector('.addSubheadingButton').addEventListener('click', () => {
                    const subheadingsContainer = titleBlock.querySelector('.subheadings-container');
                    const subheadingInput = document.createElement('div');
                    subheadingInput.classList.add('subheading-block', 'mb-2');
                    subheadingInput.innerHTML = `
                        <input type="text" name="subheadings[${titleIndex}][]" class="form-control mb-1" required>
                        <button type="button" class="btn btn-danger btn-sm removeSubheadingButton">Remove</button>
                    `;

                    // Add event listener to remove button
                    subheadingInput.querySelector('.removeSubheadingButton').addEventListener('click', () => {
                        subheadingInput.remove();
                    });

                    subheadingsContainer.appendChild(subheadingInput);
                });

                facultiesContainer.appendChild(titleBlock);
                titleIndex++;
            };

            // Event listener for adding title blocks
            addTitleButton.addEventListener('click', createTitleBlock);
        });
    </script>
@endpush