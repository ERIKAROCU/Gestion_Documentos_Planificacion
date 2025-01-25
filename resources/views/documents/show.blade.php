<x-base-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Documento') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>Número de Documento:</strong> {{ $document->numero_documento }}
                    </div>
                    <div class="mb-4">
                        <strong>Fecha de Ingreso:</strong> {{ $document->fecha_ingreso }}
                    </div>
                    <div class="mb-4">
                        <strong>Origen:</strong> {{ $document->origen }}
                    </div>
                    <div class="mb-4">
                        <strong>Título:</strong> {{ $document->titulo }}
                    </div>
                    <div class="mb-4">
                        <strong>Número de Folios:</strong> {{ $document->numero_folios }}
                    </div>
                    <div class="mb-4">
                        <strong>Detalles:</strong> {{ $document->detalles }}
                    </div>

                    <!-- Sección para mostrar archivo -->
                    <div class="mb-4">
                        <strong>Archivo:</strong>
                        @if ($document->files->isNotEmpty())
                            <a href="{{ Storage::url($document->files->first()->archivo_path) }}" 
                               class="btn btn-success" target="_blank">Descargar Archivo</a>
                        @else
                            <span>No hay archivo asociado</span>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</button>
                        </form>
                        <a href="{{ route('documents.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
