<!-- resources/views/services/action.blade.php -->
<a href="{{ route('quebec.climates.packing-list.show', ['id' => $row->quebec_climate_id , 'packing_list' => $row->id]) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('quebec.climates.packing-list.edit', ['id' => $row->quebec_climate_id , 'packing_list' => $row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
<form action="{{ route('quebec.climates.packing-list.destroy', ['id' => $row->quebec_climate_id , 'packing_list' => $row->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
