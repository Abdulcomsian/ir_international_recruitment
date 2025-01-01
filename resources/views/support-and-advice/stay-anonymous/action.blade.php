<!-- resources/views/services/action.blade.php -->
<a href="{{ route('support-and-advice.stay-anonymous.show', $id) }}" class="btn btn-info btn-sm">View</a>
<form action="{{ route('support-and-advice.stay-anonymous.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
