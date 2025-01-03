<div class="action-col">

    <a href="{{ route('quebec.historical.event.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
    <form action="{{ route('quebec.historical.event.delete', $id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

</div>
