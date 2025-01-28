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

                    <div class="mb-4">
                        <strong>Derivado:</strong> 
                        {{ $document->derivado }}
                        @if (empty($document->derivado))
                            <span class="text-sm text-red-700"> No hay registro de derivado.</span>
                        @endif
                    </div> 
                    
                    <div class="mb-4">
                        <strong>Fecha de Salida:</strong> 
                        {{ $document->fecha_salida }}
                        @if (empty($document->fecha_salida))
                            <span class="text-sm text-red-700"> No hay registro de fecha de salida.</span>
                        @endif
                    </div> 
                    
                    <div class="mb-4">
                        <strong>Responsable:</strong> 
                        @if ($document->trabajador)
                            {{ $document->trabajador->name }}
                        @else
                            <span class="text-sm text-red-600">Sin asignar</span>
                        @endif
                    </div>

                    <div class="mb-4">
                        <strong>Archivo:</strong>
                        @if ($document->files->isNotEmpty())
                            @foreach ($document->files as $file)
                                <a href="{{ Storage::url($file->archivo_path) }}" 
                                    class="inline-block bg-green-800 text-white py-2 px-4 rounded-md hover:bg-green-600" target="_blank">Descargar Archivo
                                </a>
                            @endforeach
                        @else
                            <span class="text-sm text-red-600">No hay archivo asociado</span>
                        @endif
                    </div>
                    

                    <div class="mt-4">
                        <a href="{{ route('ad.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" aria-label="Volver a la lista">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
