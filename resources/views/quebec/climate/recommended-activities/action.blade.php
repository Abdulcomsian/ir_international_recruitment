<!-- resources/views/services/action.blade.php -->
<a href="{{ route('quebec.climates.recommended-activities.show', ['id' => $row->quebec_climate_id , 'recommended_activity' => $row->id]) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('quebec.climates.recommended-activities.edit', ['id' => $row->quebec_climate_id , 'recommended_activity' => $row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('quebec.climates.recommended-activities.destroy', ['id' => $row->quebec_climate_id , 'recommended_activity' => $row->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
