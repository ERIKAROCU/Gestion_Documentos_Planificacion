<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Documentos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">

                    <!-- Componente de búsqueda -->
                    @include('ad-components.search')

                    @if ($documents->isEmpty())
                        <p class="text-gray-600">No hay documentos registrados.</p>
                    @else
                        @include('ad-components.table', ['documents' => $documents])
                    @endif
                </div>
            </div>
            <!-- Modal para mostrar detalles de documentos -->
            @include('ad-components.modal')
        </div>
    </div>
    <!-- Scripts adicionales -->
    @include('ad-components.scripts')
</x-app-layout>
