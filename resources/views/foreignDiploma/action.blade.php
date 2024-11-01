<!-- resources/views/services/action.blade.php -->
<a href="{{ route('foreign.diploma.fields.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('foreign.diploma.fields.delete', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
