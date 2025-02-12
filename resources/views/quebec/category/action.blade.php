<!-- resources/views/services/action.blade.php -->
<!-- <a href="{{ route('quebec-history-categories.show', $id) }}" class="btn btn-info btn-sm">View</a> -->
<a href="{{ route('quebec-history-categories.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('quebec-history-categories.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
