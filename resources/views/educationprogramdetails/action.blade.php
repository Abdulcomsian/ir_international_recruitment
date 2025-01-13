 <div class="action-col">
 <a href="{{ route('eductional.programs.details.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
<a href="{{ route('eductional.programs.details.view', $id) }}" class="btn btn-secondary btn-sm">View</a>
<form action="{{ route('eductional.programs.details.delete', $id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
 </div>

