<!-- resources/views/services/action.blade.php -->
 <div class="action-col">
     
     <a href="{{ route('culture.quiz.overview.index', $id) }}" class="btn btn-success btn-sm">Manage Overview</a>
     <a href="{{ route('culture.quiz.questions.index', $id) }}" class="btn btn-warning btn-sm">Manage Questions</a>
     
     <a href="{{ route('culture.quiz.show', $id) }}" class="btn btn-info btn-sm">View</a>
     <a href="{{ route('culture.quiz.edit', $id) }}" class="btn btn-primary btn-sm">Edit</a>
     <form action="{{ route('culture.quiz.destroy', $id) }}" method="POST" style="display:inline;">
         @csrf
         @method('DELETE')
         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
</div>
