<div class="action-col">
    <a href="{{ route('quebec.legal-aspects.quiz.show', ['id' => $row->quebec_legal_aspect_id , 'quiz' => $row->id]) }}" class="btn btn-info btn-sm">View</a>
    <a href="{{ route('quebec.legal-aspects.quiz.edit', ['id' => $row->quebec_legal_aspect_id , 'quiz' => $row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
    <form action="{{ route('quebec.legal-aspects.quiz.destroy', ['id' => $row->quebec_legal_aspect_id , 'quiz' => $row->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    <a href="{{ route('quebec.legal-aspects.quiz.overview.index', ['id' => $row->quebec_legal_aspect_id , 'overview' => $row->id]) }}" class="btn btn-success btn-sm">Manage Overview</a>

    <a href="{{ route('quebec.legal-aspects.quiz.question.index', ['id' => $row->quebec_legal_aspect_id , 'overview' => $row->id]) }}" class="btn btn-warning btn-sm">Manage Questions</a>

</div>
    
