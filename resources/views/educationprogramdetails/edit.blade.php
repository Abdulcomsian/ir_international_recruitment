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

           
           
    


            @php
    // You already passed faculties data from the controller to the view
    $faculties = $faculties;
@endphp

<div class="form-group">
    <label for="faculties">Faculties</label>
    <br>
    <button type="button" id="addTitleButton" class="btn btn-primary">Add</button>
    <div id="facultiesContainer">
        @foreach($faculties as $faculty)
            <div class="title-block mb-1" data-index="{{ $loop->index }}">
                <!-- Faculty Title -->
                <div class="d-flex align-items-center mb-2">
                    <input type="text" name="titles[{{ $loop->index }}]" class="form-control flex-grow-1 me-2" value="{{ $faculty->title }}" required>
                    <button type="button" class="btn btn-secondary addSubheadingButton btn-sm" style="width: 100px; height: calc(1.5em + .75rem + 2px);">Add Program</button>
                </div>


                <div class="subheadings-container mt-2">
                    @foreach($faculty->subPrograms as $subheading)
                        <div class="subheading-block mb-2">
                            <input type="text" name="subheadings[{{ $loop->parent->index }}][]" class="form-control mb-1" value="{{ $subheading->subheading }}" required>
                            <button type="button" class="btn btn-danger btn-sm removeSubheadingButton">Remove</button>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <label>Department</label>
                    <button type="button" class="btn btn-danger btn-sm removeTitleButton">Remove Department</button>
                </div>
            </div>
        @endforeach
    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addTitleButton = document.getElementById('addTitleButton');
            const facultiesContainer = document.getElementById('facultiesContainer');
            // console.log($faculties);
            // let titleIndex = {{ count($faculties) }}; // Start index for new faculties
            let titleIndex=0;
            // Function to create a new title block (faculty)
            const createTitleBlock = () => {
                const titleBlock = document.createElement('div');
                titleBlock.classList.add('title-block', 'mb-3');
                titleBlock.dataset.index = titleIndex; // Set index for this block

                // Title block structure
                titleBlock.innerHTML = `
                    <input type="text" name="titles[${titleIndex}]" class="form-control mb-2" required>
                    <button type="button" class="btn btn-secondary addSubheadingButton" data-index="${titleIndex}">Add Program</button>
                    <div class="subheadings-container mt-2"></div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <label>Department</label>
                        <button type="button" class="btn btn-danger btn-sm removeTitleButton">Remove Department</button>
                    </div>
                `;

                // Add event listener to "Add Program" button
                titleBlock.querySelector('.addSubheadingButton').addEventListener('click', (el) => {
                    let facultyIndex = el.target.getAttribute('data-index')
                    const subheadingsContainer = titleBlock.querySelector('.subheadings-container');
                    addSubheading(subheadingsContainer, facultyIndex);
                });

                // Add event listener to "Remove Department" button
                titleBlock.querySelector('.removeTitleButton').addEventListener('click', () => {
                    titleBlock.remove();
                });

                facultiesContainer.appendChild(titleBlock);
                titleIndex++;
            };

            // Function to add a subheading (program)
            const addSubheading = (container, index) => {
                const subheadingInput = document.createElement('div');
                subheadingInput.classList.add('subheading-block', 'mb-2');
                subheadingInput.innerHTML = `
                    <input type="text" name="subheadings[${index}][]" class="form-control mb-1" required>
                    <button type="button" class="btn btn-danger btn-sm removeSubheadingButton">Remove</button>
                `;

                // Add event listener to remove subheading
                subheadingInput.querySelector('.removeSubheadingButton').addEventListener('click', () => {
                    subheadingInput.remove();
                });

                container.appendChild(subheadingInput);
            };

            // Attach event listener for adding new title blocks
            addTitleButton.addEventListener('click', createTitleBlock);

            // Attach event listeners to existing title blocks and subheadings (if preloaded)
            facultiesContainer.querySelectorAll('.title-block').forEach(titleBlock => {
                const currentIndex = titleBlock.dataset.index;

                // Preload existing subheadings for each faculty
                @foreach($faculties as $faculty)
                    if ({{ $faculty->id }} === currentIndex) {
                        const subheadingsContainer = titleBlock.querySelector('.subheadings-container');
                        @if($faculty->subheadings && count($faculty->subheadings) > 0)
                            @foreach($faculty->subheadings as $subheading)
                                const subheadingInput = document.createElement('div');
                                subheadingInput.classList.add('subheading-block', 'mb-2');
                                subheadingInput.innerHTML = `
                                    <input type="text" name="subheadings[${currentIndex}][]" class="form-control mb-1" value="{{ $subheading->name }}" required>
                                    <button type="button" class="btn btn-danger btn-sm removeSubheadingButton">Remove</button>
                                `;
                                // subheadingInput.querySelector('.removeSubheadingButton').addEventListener('click', () => {
                                //     subheadingInput.remove();
                                // });
                                subheadingsContainer.appendChild(subheadingInput);
                            @endforeach
                        @endif
                    }
                @endforeach

                // Attach listener for "Add Program" button
                titleBlock.querySelector('.addSubheadingButton').addEventListener('click', () => {
                    const subheadingsContainer = titleBlock.querySelector('.subheadings-container');
                    addSubheading(subheadingsContainer, currentIndex);
                });

                // Attach listener for "Remove Department" button
                titleBlock.querySelector('.removeTitleButton').addEventListener('click', () => {
                    titleBlock.remove();
                });

                // Attach listeners for existing subheadings (if any)
                titleBlock.querySelectorAll('.subheading-block').forEach(subheadingBlock => {
                    subheadingBlock.querySelector('.removeSubheadingButton').addEventListener('click', () => {
                        subheadingBlock.remove();
                    });
                });
            });
        });
    </script>

@endpush 