<!-- resources/views/services/action.blade.php -->
<a href="{{ route('cities.upload-cityVideo.edit', [$model->city_id, $model->id]) }}" class="btn btn-primary btn-sm">Edit</a>

<form action="{{ route('cities.upload-cityVideo.destroy', [$model->city_id, $model->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
