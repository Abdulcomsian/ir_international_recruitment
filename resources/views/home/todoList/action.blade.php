<div class="action-col">

    <a href="{{ route('toDoList.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
    <a href="{{ route('toDoList.show', $id) }}" class="btn btn-secondary btn-sm">View</a>
    <form action="{{ route('toDoList.destroy', $id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

</div>
