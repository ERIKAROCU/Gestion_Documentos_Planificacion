<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class DocumentController extends Controller
{
    // Mostrar todos los documentos
    public function index(Request $request)
    {
        $query = $request->input('q');

        $documents = Document::with('files') // Asegúrate de cargar las relaciones necesarias.
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('titulo', 'like', "%$query%")
                            ->orWhere('origen', 'like', "%$query%")
                            ->orWhereDate('fecha_ingreso', 'like', "%$query%");
            })
            ->paginate(10); // Pagina los resultados para evitar cargar demasiados datos.

        // Verificar si la solicitud es AJAX
        if ($request->ajax()) {
            return view('documents-components.table', compact('documents'))->render();
        }

        return view('documents.index', compact('documents'));
    }

    // Mostrar formulario para crear un nuevo documento
    public function create()
    {
        return view('documents.create');
    }

    // Guardar un nuevo documento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_documento' => 'required|unique:documents',
            'fecha_ingreso' => 'required|date',
            'origen' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'numero_folios' => 'required|integer',
            'detalles' => 'nullable|string',
        ]);

        $document = Document::create($validated);
        return redirect()->route('documents.index')->with('success', 'Documento creado con éxito.');
    }

    // Mostrar un documento específico
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    // Mostrar formulario para editar un documento
    public function edit(Document $document)
    {
        if (request()->ajax()) {
            return view('documents.edit', compact('document'))->render();
        }
    
        return view('documents.edit', compact('document'));
    }

    // Actualizar un documento
    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'numero_documento' => 'required|unique:documents,numero_documento,' . $document->id,
            'fecha_ingreso' => 'required|date',
            'origen' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'numero_folios' => 'required|integer',
            'detalles' => 'nullable|string',
        ]);

        $document->update($validated);
        return redirect()->route('documents.index')->with('success', 'Documento actualizado con éxito.');
    }

    // Eliminar un documento
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Documento eliminado con éxito.');
    }

    // Mostrar formulario para derivar un documento
    public function updateDerivation(Request $request, $id)
    {
        $document = Document::findOrFail($id);
    
        $validated = $request->validate([
            'derivado'      => 'required|string|max:255',
            'fecha_salida'  => 'required|date',
            'trabajador_id' => 'nullable|exists:users,id',
            'file'          => 'nullable|file|mimes:pdf,doc,docx,xlsx|max:5120', // 5MB
        ]);
    
        // Actualizar documento
        $document->update([
            'derivado' => $validated['derivado'],
            'fecha_salida' => $validated['fecha_salida'],
            'trabajador_id' => Auth::user()->id, // ID del usuario autenticado
        ]);
    
        // Verificar si hay un archivo asociado
        if ($request->hasFile('file')) {
            // Si ya existe un archivo asociado, se actualiza el primero
            $file = $document->files()->first(); // Obtener el primer archivo asociado al documento
    
            if ($file) {
                // Si hay un archivo existente, actualízalo
                $filePath = $request->file('file')->store('documents', 'public');
                $originalFileName = $request->file('file')->getClientOriginalName(); // Obtener el nombre original
    
                $file->update([
                    'archivo_path' => $filePath,
                    'tipo' => $request->file('file')->getClientOriginalExtension(),
                    'nombre_original' => $originalFileName, // Guardar el nombre original
                ]);
            } else {
                // Si no hay archivo asociado, se guarda uno nuevo
                $filePath = $request->file('file')->store('documents', 'public');
                $originalFileName = $request->file('file')->getClientOriginalName(); // Obtener el nombre original
    
                $document->files()->create([
                    'archivo_path' => $filePath,  // Asignar la ruta del archivo
                    'tipo' => $request->file('file')->getClientOriginalExtension(),
                    'nombre_original' => $originalFileName, // Guardar el nombre original
                ]);
            }
        }
    
        return redirect()->route('documents.index')->with('success', 'Documento actualizado correctamente.');
    }
    

    public function editDerivation($id)
    {
        $document = Document::findOrFail($id);
        $trabajadores = User::all(); // Obtener todos los trabajadores (suponiendo que tienes un modelo Trabajador)

        return view('documents.update-derivation', compact('document', 'trabajadores'));
    }

}
