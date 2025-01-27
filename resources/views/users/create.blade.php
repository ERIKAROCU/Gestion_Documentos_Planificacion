<x-base-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="dni" class="form-label">Dni</label>
                            <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="form-label">Estado</label>
                            <select name="is_active" class="form-control">
                                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
