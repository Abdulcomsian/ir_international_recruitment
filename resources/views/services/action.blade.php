<!-- resources/views/services/action.blade.php -->
<div class="action-col">

    <a href="{{ route('services.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
    <form action="{{ route('services.destroy', $id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

</div>
