<!-- resources/views/services/action.blade.php -->
<a href="{{ route('quebec.climates.show', $id) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('quebec.climates.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('quebec.climates.destroy', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
<a href="{{ route('quebec.climates.seasonal', $id) }}" class="btn btn-secondary btn-sm">Seasonal</a>
<a href="{{ route('quebec.climates.packing-list.index', $id) }}" class="btn btn-info btn-sm">Packing List</a>
