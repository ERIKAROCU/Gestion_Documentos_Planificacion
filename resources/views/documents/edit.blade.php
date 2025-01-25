<x-base-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Documento') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('documents.update', $document->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="numero_documento" class="block text-gray-700">Número de Documento</label>
                            <input type="text" name="numero_documento" id="numero_documento" class="form-input mt-1 block w-full" value="{{ $document->numero_documento }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="fecha_ingreso" class="block text-gray-700">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-input mt-1 block w-full" value="{{ $document->fecha_ingreso }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="titulo" class="block text-gray-700">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-input mt-1 block w-full" value="{{ $document->titulo }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="origen" class="block text-gray-700">Origen</label>
                            <input type="text" name="origen" id="origen" class="form-input mt-1 block w-full" value="{{ $document->origen }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="numero_folios" class="block text-gray-700">Número de Folios</label>
                            <input type="number" name="numero_folios" id="numero_folios" class="form-input mt-1 block w-full" value="{{ $document->numero_folios }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="detalles" class="block text-gray-700">Detalles</label>
                            <textarea name="detalles" id="detalles" class="form-input mt-1 block w-full" required>{{ $document->detalles }}</textarea>
                        </div>
                        <!-- Otros campos aquí -->
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
