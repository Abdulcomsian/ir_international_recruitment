<!-- resources/views/services/action.blade.php -->
<a href="{{ route('diploma.resource.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('diploma.resource.delete', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
