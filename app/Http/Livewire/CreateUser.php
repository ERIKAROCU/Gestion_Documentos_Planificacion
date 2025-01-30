<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name, $dni, $email, $password, $password_confirmation, $is_active = 1;

    // Reglas de validación
    protected $rules = [
        'name' => 'required|string|max:255',
        'dni' => 'required|numeric|unique:users,dni',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'is_active' => 'required|boolean',
    ];

    // Mensajes personalizados para validación
    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'dni.required' => 'El DNI es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'password.required' => 'La contraseña es obligatoria.',
        'is_active.required' => 'El estado es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no debe exceder los 255 caracteres.',
        'dni.numeric' => 'El DNI debe ser un número.',
        'dni.unique' => 'El DNI ya está registrado.',
        'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'email.unique' => 'El correo electrónico ya está registrado.',
        'password.string' => 'La contraseña debe ser una cadena de texto.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        'is_active.boolean' => 'El estado debe ser verdadero o falso.',
    ];

    public function createUser()
    {
        // Validar los datos
        $this->validate();

        // Crear el usuario
        User::create([
            'name' => $this->name,
            'dni' => $this->dni,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => $this->is_active,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Usuario creado con éxito.');

        // Redirigir a la página de índice de usuarios
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}