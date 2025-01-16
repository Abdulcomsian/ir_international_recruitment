
<a href="{{ route('city.guide.categories.show', $id) }}" class="btn btn-info btn-sm">View</a>

<a href="{{ route('city.guide.categories.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>

<form action="{{ route('city.guide.categories.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>