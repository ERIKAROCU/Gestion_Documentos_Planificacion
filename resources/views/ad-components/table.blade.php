<div id="documents-container" class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 text-center">
                <th class="px-3 py-3 font-semibold text-sm text-gray-600 border-b">N°</th>
                <th class="px-6 py-3 font-semibold text-sm text-gray-600 border-b">Título</th>
                <th class="px-6 py-3 font-semibold text-sm text-gray-600 border-b">Fecha de Ingreso</th>
                <th class="px-6 py-3 font-semibold text-sm text-gray-600 border-b">Origen</th>
                <th class="px-6 py-3 font-semibold text-sm text-gray-600 border-b">Destino</th>
                <th class="px-6 py-3 font-semibold text-sm text-gray-600 border-b">Responsable</th>
                <th class="px-6 py-3 font-semibold text-sm text-gray-600 border-b">Archivo</th>
                <th class="px-8 py-3 font-semibold text-sm text-gray-600 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-3 py-3 text-sm text-center text-gray-700">{{ $document->numero_documento }}</td>
                    <td class="px-6 py-3 text-sm text-center text-gray-700">{{ $document->titulo }}</td>
                    <td class="px-6 py-3 text-sm text-center text-gray-700">{{ $document->fecha_ingreso }}</td>
                    <td class="px-6 py-3 text-sm text-center text-gray-700">{{ $document->origen }}</td>
                    <td class="px-6 py-3 text-sm text-center text-gray-700">
                        @if ($document->derivado)
                            {{ $document->derivado }}
                        @else
                            <span class="text-gray-500">No se derivó</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-sm text-center text-gray-700">
                        @if ($document->trabajador)
                            {{ $document->trabajador->name }}
                        @else
                            <span class="text-gray-500">Sin asignar</span>
                        @endif
                    </td>                    
                    
                    <td class="px-6 py-3 text-sm text-center text-gray-700">
                        @if ($document->files->isNotEmpty())
                            <a href="{{ Storage::url($document->files->first()->archivo_path) }}" class="inline-block bg-green-800 text-white py-2 px-4 rounded-md hover:bg-green-600 text-sm" target="_blank">
                                Descargar
                            </a>
                        @else
                            <span class="text-white inline-block bg-red-800 py-2 px-4 rounded-md text-sm">No hay archivo</span>
                        @endif
                    </td>
                    <td class="px-8 py-3 text-sm text-center text-gray-700 space-x-2">
                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">
                            <a href="{{ route('ad.show', $document) }}" 
                            class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 text-sm transition duration-200"
                            data-bs-toggle="modal" 
                            data-bs-target="#documentModal" 
                            data-url="{{ route('ad.show', $document) }}" 
                            data-title="Detalles del Documento">
                                Ver
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-600">No se encontraron resultados para "{{ request('q') }}"</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $documents->links() }} <!-- Paginación -->
</div>
