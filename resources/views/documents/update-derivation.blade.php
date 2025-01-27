<x-base-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('documents.update-derivation', $document->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Derivado (Oficina) -->
                        <div class="mb-4">
                            <label for="derivado" class="block text-sm font-medium text-gray-700">Derivado (Oficina)</label>
                            <select name="derivado" id="derivado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">Seleccionar Oficina</option>
                                @foreach ($oficinas as $oficina)
                                    <option value="{{ $oficina->nombre }}" {{ old('derivado', $document->derivado) == $oficina->nombre ? 'selected' : '' }}>
                                        {{ $oficina->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('derivado')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- Campo para fecha de salida -->
                        <div class="mb-4">
                            <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                            <input type="date" name="fecha_salida" id="fecha_salida" 
                                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                   value="{{ old('fecha_salida', $document->fecha_salida) }}" required>
                            @error('fecha_salida')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Campo para archivo (opcional) -->
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">Archivo (opcional)</label>
                            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xlsx" 
                                   class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Botón para guardar -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Actualizar Documento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
