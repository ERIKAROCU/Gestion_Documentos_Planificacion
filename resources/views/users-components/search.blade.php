<form action="{{ route('users.index') }}" method="GET" class="mb-4">
    <div class="flex items-center">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Buscar por nombre, dni o correo" 
               class="mr-2 px-4 py-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 w-100">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Buscar</button>
    </div>
</form>