<x-base-layout title="Registrar Nuevo Documento">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Documento') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('documents.store') }}">
                        @csrf

                        <!-- Número de Documento -->
                        <div class="mb-4">
                            <label for="numero_documento" class="block text-gray-700">Número de Documento</label>
                            <input type="text" name="numero_documento" id="numero_documento"
                                class="form-input mt-1 block w-full" value="{{ old('numero_documento') }}" required>
                            @error('numero_documento')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Fecha de Ingreso -->
                        <div class="mb-4">
                            <label for="fecha_ingreso" class="block text-gray-700">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-input mt-1 block w-full"
                                value="{{ old('fecha_ingreso') }}" required>
                            @error('fecha_ingreso')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Origen (Oficina) -->
                        {{-- <div class="mb-4">
                            <label for="origen" class="block text-gray-700">Origen (Oficina)</label>
                            <input type="text" name="origen" id="origen" class="form-input mt-1 block w-full"
                                value="{{ old('origen') }}" required>
                            @error('origen')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <!-- Origen (Oficina) -->
                        <div class="mb-4">
                            <label for="origen" class="block text-gray-700">Origen (Oficina)</label>
                            <select name="origen" id="origen" class="form-input mt-1 block w-full" required>
                                <option value="">Seleccionar Oficina</option>
                                @foreach ($oficinas as $oficina)
                                    <option value="{{ $oficina->nombre }}" {{ old('origen') == $oficina->nombre ? 'selected' : '' }}>
                                        {{ $oficina->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('origen')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Título del Documento -->
                        <div class="mb-4">
                            <label for="titulo" class="block text-gray-700">Título del Documento</label>
                            <input type="text" name="titulo" id="titulo" class="form-input mt-1 block w-full"
                                value="{{ old('titulo') }}" required>
                            @error('titulo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Número de Folios -->
                        <div class="mb-4">
                            <label for="numero_folios" class="block text-gray-700">Número de Folios</label>
                            <input type="number" name="numero_folios" id="numero_folios" class="form-input mt-1 block w-full"
                                value="{{ old('numero_folios') }}" required>
                            @error('numero_folios')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Detalles -->
                        <div class="mb-4">
                            <label for="detalles" class="block text-gray-700">Detalles</label>
                            <textarea name="detalles" id="detalles" class="form-input mt-1 block w-full" rows="4"
                                required>{{ old('detalles') }}</textarea>
                            @error('detalles')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="mb-4">
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600">
                                Registrar Documento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
