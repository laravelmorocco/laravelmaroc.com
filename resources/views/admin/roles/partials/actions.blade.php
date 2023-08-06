<a href="{{ route('roles.edit', $data->id) }}" class="btn btn-info btn-sm">
    <i class="bi bi-pencil"></i>
</a>
<button id="delete" class="btn btn-danger btn-sm" onclick="
    event.preventDefault();
    if (confirm('Are you sure? It will delete the data permanently!')) {
    document.getElementById('destroy{{ $data->id }}').submit();
    }
    ">
    <i class="fas fa-trash-alt"></i>
    <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('roles.destroy', $data->id) }}" method="POST">
        @csrf
        @method('delete')
    </form>
</button>
