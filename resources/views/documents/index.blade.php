<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Documentos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#documentModal" data-url="{{ route('documents.create') }}" data-title="Nuevo Documento">
                        Nuevo Documento
                    </a>

                    @if ($documents->isEmpty())
                        <p>No hay documentos registrados.</p>
                    @else
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
                                @foreach ($documents as $document)
                                    <tr>
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
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentModalLabel">Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="modalContent">
                                <p>Cargando...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('documentModal');
            const modalContent = document.getElementById('modalContent');
            const modalTitle = document.getElementById('documentModalLabel');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                const title = button.getAttribute('data-title') || 'Modal';

                modalTitle.textContent = title;
                modalContent.innerHTML = '<p>Cargando...</p>';

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        modalContent.innerHTML = html;
                    })
                    .catch(error => {
                        modalContent.innerHTML = '<p>Error al cargar el contenido.</p>';
                        console.error('Error:', error);
                    });
            });
        });
    </script>
</x-app-layout>
