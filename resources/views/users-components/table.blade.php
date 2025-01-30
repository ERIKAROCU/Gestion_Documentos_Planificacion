<table class="min-w-full table-auto border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="px-4 py-2 font-semibold text-sm text-gray-600 border-b">Nombre</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-600 border-b">DNI</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-600 border-b">Email</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-600 border-b">Estado</th>
            <th class="px-4 py-2 font-semibold text-sm text-gray-600 border-b">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $user->dni }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $user->email }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">
                    {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                </td>
                <td class="px-4 py-2 text-sm text-gray-700 flex space-x-2">
                    
                    @livewire('edit-user', ['user' => $user], key($user->id))

                    {{-- <button wire:click="$emit('editUser', {{ $user->id }})" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                        Editar
                    </button>   --}}                  


                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
