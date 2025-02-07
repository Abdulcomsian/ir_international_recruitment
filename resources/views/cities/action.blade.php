<!-- resources/views/services/action.blade.php -->
<a href="{{ route('cities.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<a href="{{ route('cities.upload-cityVideo.index', $id) }}" class="btn btn-secondary btn-sm">Upload Video</a>


<form action="{{ route('cities.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
