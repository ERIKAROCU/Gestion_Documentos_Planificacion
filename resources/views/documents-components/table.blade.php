<div id="documents-container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Título</th>
                <th>Fecha de Ingreso</th>
                <th>Origen</th>
                <th>Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
                <tr class="border-t hover:bg-gray-50">
                    <td>{{ $document->id }}</td>
                    <td>{{ $document->titulo }}</td>
                    <td>{{ $document->fecha_ingreso }}</td>
                    <td>{{ $document->origen }}</td>
                    <td>
                        @if ($document->files->isNotEmpty())
                            <a href="{{ Storage::url($document->files->first()->archivo_path) }}" class="btn btn-success" target="_blank">
                                Descargar Archivo
                            </a>
                        @else
                            <span>No hay archivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('documents.show', $document) }}" 
                           class="btn btn-info" 
                           data-bs-toggle="modal" 
                           data-bs-target="#documentModal" 
                           data-url="{{ route('documents.show', $document) }}"
                           data-title="Detalles del Documento">
                            Ver
                        </a>
                        <a href="{{ route('documents.edit', $document) }}" 
                           class="btn btn-warning" 
                           data-bs-toggle="modal" 
                           data-bs-target="#documentModal" 
                           data-url="{{ route('documents.edit', $document) }}"
                           data-title="Editar Documento">
                            Editar
                        </a>
                        <a href="{{ route('documents.update-derivation', $document) }}" 
                           class="btn btn-secondary" 
                           data-bs-toggle="modal" 
                           data-bs-target="#documentModal" 
                           data-url="{{ route('documents.update-derivation', $document) }}"
                           data-title="Emitir Documento">
                            Emitir Documento
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No se encontraron resultados para "{{ request('q') }}"</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $documents->links() }} <!-- Muestra la paginación -->
</div>
