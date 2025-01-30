<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $role = Auth::user()->role;
        
        // Verificar si el usuario autenticado es administrador
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        // Obtener el valor de búsqueda de la petición
        $search = $request->input('search');

        // Si se realiza una búsqueda, filtrar por nombre o correo electrónico
        $users = User::query()
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('dni', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10); // Paginación de 10 usuarios por página

        // Devolver la vista con los usuarios filtrados
        return view('users.index', compact('users'));
    }

    public function create(Request $request)
    {
        // Verificar si el usuario autenticado es administrador
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        // Verificar si el usuario tiene el rol de admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        // Crear el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => $request->is_active,
            'dni' => $request->dni,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }
    
    public function edit(User $user)
    {
        // Verificar si el usuario autenticado es administrador
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        // Retornar la vista de edición con los datos del usuario
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'dni' => 'required',
            'is_active' => 'required|boolean',
            'role' => 'required',
            'password' => 'nullable|string|min:8|confirmed', // Hacemos que sea opcional
        ]);

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dni = $request->dni;
        $user->role = $request->role;
        $user->is_active = $request->is_active;

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Guardar el usuario
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
