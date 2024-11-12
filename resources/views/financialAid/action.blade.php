<a href="{{ route('financial.aid.programs.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('financial.aid.programs.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
