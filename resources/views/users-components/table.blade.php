<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->dni }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>