<!-- resources/views/services/action.blade.php -->
<a href="{{ route('diploma.validation.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('diploma.validation.delete', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
