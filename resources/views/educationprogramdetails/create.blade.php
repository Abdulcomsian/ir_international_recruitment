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

            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" id="about" name="about" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group">
                <label for="Financial Aid">Financial Aid</label>
                <textarea class="form-control" id="financial_aid" name="financial_aid" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group">
                <label for="campus ">Campus</label>
                <textarea class="form-control" id="campus" name="campus" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group">
                <label for="faculties ">Faculties</label>
                <textarea class="form-control" id="faculties" name="faculties" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group">
                <label for="additional_program">Additional Program</label>
                <textarea class="form-control" id="additional_program" name="additional_program" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group">
                <label for="research">Research</label>
                <textarea class="form-control" id="research" name="research" rows="4" cols="50" required></textarea>
            </div>

            <div class="form-group">
                <label for="student_life">Student Life</label>
                <textarea class="form-control" id="student_life" name="student_life" rows="4" cols="50" required></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Add University Details</button>
        </form>
    </div>
@endsection
