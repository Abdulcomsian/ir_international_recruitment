<!-- resources/views/services/action.blade.php -->
<a href="{{ route('eductional.programs.details.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('eductional.programs.details.delete', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
