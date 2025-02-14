<!-- resources/views/services/action.blade.php -->
<a href="{{ route('history-quebec.show', $id) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('history-quebec.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('history-quebec.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
