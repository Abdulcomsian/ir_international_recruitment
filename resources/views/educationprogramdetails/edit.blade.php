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

            <div class="form-group">
                <label for="label">About</label>
                <textarea class="form-control" id="about" name="about"  rows="4" cols="50" required>{{ old('about', $program->about) }}</textarea>
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
          
            
            <button type="submit" class="btn btn-success">Update UniversityDetail</button>
        </form>
    </div>
@endsection
