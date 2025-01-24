@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Edit Quiz Category Overview</h1>
        <form action="{{ route('quebec.legal-aspects.quiz.overview.update', ['id' => $id, 'overview' => $overview]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" />
                <small>Current Image: 
                    <img src="{{ asset($overview->featured_image) }}" alt="Current Image" style="height: 50px;">
                </small>
                @error('featured_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title Question</label>
                <input type="text" class="form-control" id="title" name="title_question" value="{{ old('title_question', $overview->title_question) }}" required />
                @error('title_question')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $overview->description) }}" required />
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Labels and Label Images Section -->
            <div id="label-section">
                <label>Labels & Label Images</label>
                @foreach ($overview->getoverviewLabels as $index => $label)
                    <div class="label-item mt-3">
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" name="labels[]" value="{{ old('labels.' . $index, $label->label) }}" required />
                        </div>
                        <div class="form-group">
                            <label for="label_image">Label Image</label>
                            <input type="file" class="form-control" name="label_images[]" />
                            <small>Current Image: 
                                <img src="{{ asset('storage/' . $label->label_image) }}" alt="Current Label Image" style="height: 50px;">
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add More Labels Button -->
            <div class="form-group">
                <button type="button" id="add-label-btn" class="btn btn-secondary">Add Another Label</button>
            </div>

            <button type="submit" class="btn btn-success mt-2">Update Quiz Category Overview</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const labelSection = document.getElementById('label-section');
            const addLabelBtn = document.getElementById('add-label-btn');

            addLabelBtn.addEventListener('click', function () {
                const labelItem = document.createElement('div');
                labelItem.classList.add('label-item', 'mt-3');
                labelItem.innerHTML = `
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" class="form-control" name="labels[]" placeholder="Enter Label" required />
                    </div>
                    <div class="form-group">
                        <label for="label_image">Label Image</label>
                        <input type="file" class="form-control" name="label_images[]" required />
                    </div>
                `;
                labelSection.appendChild(labelItem);
            });
        });
    </script>
@endpush
