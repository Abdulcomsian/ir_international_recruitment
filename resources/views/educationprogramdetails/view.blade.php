@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View University Details</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="title">University</label>
                        <div>
                            {{ $program->educationProgram->title ?? '' }}
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <label for="description">Address</label>
                        <div>
                            {!! nl2br($program->address) !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="description">About</label>
                        <div>
                            {!! nl2br($program->about) !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="description">Financial Aid</label>
                        <div>
                            {!! nl2br($program->financial_aid) !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="description">Campus</label>
                        <div>
                            {!! nl2br($program->campus) !!}
                        </div>
                    </div>

                    
                    <div class="col-sm-12">
                        <label for="description">Faculties</label>
                        <div>
                            @forelse($program->getFaculty as $faculty)
                            <p>Department</p>
                                <p>{!! $faculty->title ?? 'Unnamed Faculty' !!}</p>

                                <!-- Subprograms under the Faculty -->
                                @if($faculty->subPrograms && $faculty->subPrograms->isNotEmpty())
                                    <ul>
                                    <p>Programs</p>

                                        @foreach($faculty->subPrograms as $subProgram)
                                            <li>{!! $subProgram->subheading ?? 'Unnamed Subprogram' !!}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No subprograms available.</p>
                                @endif
                            @empty
                                <p>No faculties available.</p>
                            @endforelse
                        </div>
                    </div>
                    

                    <div class="col-sm-12">
                        <label for="description">Additional Program</label>
                        <div>
                            {!! nl2br($program->additional_program) !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="description">Research</label>
                        <div>
                            {!! nl2br($program->research) !!}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="description">Research</label>
                        <div>
                            {!! nl2br($program->student_life) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('eductional.programs.details.index') }}" class="btn btn-dark">University Details List</a>
    </div>
@endsection
