<div class="action-col">
    <a href="{{ route('quebec.legal-aspects.quiz.overview.show', ['id' => $row->legal_aspect_quiz_categories_id , 'overview' => $row->id]) }}" class="btn btn-info btn-sm">View</a>
    <a href="{{ route('quebec.legal-aspects.quiz.overview.edit', ['id' => $row->legal_aspect_quiz_categories_id , 'overview' => $row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
    <form action="{{ route('quebec.legal-aspects.quiz.overview.destroy', ['id' => $row->legal_aspect_quiz_categories_id , 'overview' => $row->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
    
