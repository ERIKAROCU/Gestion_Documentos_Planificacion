<x-base-layout>
    <form method="POST" action="{{ route('documents.update-derivation', $document->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <!-- Campo para derivado -->
        <div class="mb-4">
            <label for="derivado" class="block text-gray-700">Derivado</label>
            <input type="text" name="derivado" id="derivado" class="form-input mt-1 block w-full" value="{{ old('derivado', $document->derivado) }}" required>
        </div>
    
        <!-- Campo para fecha de salida -->
        <div class="mb-4">
            <label for="fecha_salida" class="block text-gray-700">Fecha de Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" class="form-input mt-1 block w-full" value="{{ old('fecha_salida', $document->fecha_salida) }}" required>
        </div>
    
        <!-- Campo para archivo (opcional) -->
        <div class="mb-4">
            <label for="file" class="block text-gray-700">Archivo (opcional)</label>
            <input type="file" name="file" id="file" class="form-input mt-1 block w-full">
        </div>
    
        <!-- Botón para guardar -->
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Actualizar Documento</button>
        </div>
    </form>
</x-base-layout>