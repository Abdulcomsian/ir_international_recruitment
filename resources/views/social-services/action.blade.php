<!-- resources/views/services/action.blade.php -->
<a href="{{ route('social-services.show', $row->id) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('social-services.edit', $row->id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('social-services.destroy', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
