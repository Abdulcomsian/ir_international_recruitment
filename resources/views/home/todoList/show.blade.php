@extends('layouts.main')

@section('content')
    <div class="container">

        <h1>View To Do list</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="title">Status</label>
                        <div>
                            {{ $list->status}}
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <label for="description">Blog</label>
                        <div>
                            {!! nl2br($list->blog) !!}
                        </div>
                    </div>

                    <div class="col-sm-12 mb-4">
                        @if ($list->featured_image)
                            <label for="Image">Featured Image</label><br />
                            <img src="{{ asset($list->featured_image) }}" alt="Featured Image" class="img-size-1" style="width:50px; height:50px;" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('toDoList.index') }}" class="btn btn-dark">To Do List</a>
    </div>
@endsection
