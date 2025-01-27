<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class AdminDocumentsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $role = Auth::user()->role;
        
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $query = $request->input('q');
        /* $documents = Document::with('trabajador')->paginate(10); */
        $documents = Document::with('files') // Asegúrate de cargar las relaciones necesarias.
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('titulo', 'like', "%$query%")
                            ->orWhere('origen', 'like', "%$query%")
                            ->orWhereDate('fecha_ingreso', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10); // Pagina los resultados para evitar cargar demasiados datos.

        // Verificar si la solicitud es AJAX
        if ($request->ajax()) {
            return view('ad-components.table', compact('documents'))->render();
        }

        return view('ad.index', compact('documents'));
    }

    public function show(Document $document, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        
        $document = Document::with('files')->findOrFail($id);
        return view('ad.show', compact('document'));
    }
}
