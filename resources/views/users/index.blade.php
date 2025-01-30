<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Componente Livewire para crear usuario -->
                    @livewire('create-user')

                    <!-- Formulario de búsqueda -->
                    @include('users-components.search')

                    @if ($users->isEmpty())
                        <p>No hay usuarios registrados.</p>
                    @else
                        @include('users-components.table', ['users' => $users]) <!-- Asegúrate de pasar 'users' y no 'documents' -->
                        {{ $users->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y Livewire -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</x-app-layout>