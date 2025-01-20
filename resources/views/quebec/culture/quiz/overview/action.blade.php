
<div class="action-col">
    <a href="{{ route('culture.quiz.overview.show',$id) }}" class="btn btn-info btn-sm">View</a>
    <a href="{{ route('culture.quiz.overview.edit',$id) }}" class="btn btn-primary btn-sm">Edit</a>
    
    <form action="{{ route('culture.quiz.overview.destroy', $id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
