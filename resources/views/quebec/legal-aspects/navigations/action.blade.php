<!-- resources/views/services/action.blade.php -->
<a href="{{ route('quebec.legal-aspects.navigations.show', ['id' => $row->quebec_legal_aspect_id , 'navigation' => $row->id]) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('quebec.legal-aspects.navigations.edit', ['id' => $row->quebec_legal_aspect_id , 'navigation' => $row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('quebec.legal-aspects.navigations.destroy', ['id' => $row->quebec_legal_aspect_id , 'navigation' => $row->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
