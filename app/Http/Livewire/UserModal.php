<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserModal extends Component
{
    public $userId;
    public $name;
    public $email;
    public $dni;
    public $is_active;
    public $role;
    public $password;
    public $confirmPassword;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'dni' => 'required|size:8|unique:users,dni',
        'is_active' => 'required|boolean',
        'role' => 'required',
        'password' => 'nullable|string|min:8|confirmed',
    ];

    public function mount($userId = null)
    {
        if ($userId) {
            $user = User::find($userId);
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->dni = $user->dni;
            $this->is_active = $user->is_active;
            $this->role = $user->role;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->userId) {
            // Editar usuario
            $user = User::find($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'dni' => $this->dni,
                'is_active' => $this->is_active,
                'role' => $this->role,
                'password' => $this->password ? bcrypt($this->password) : $user->password,
            ]);
        } else {
            // Crear nuevo usuario
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'dni' => $this->dni,
                'is_active' => $this->is_active,
                'role' => $this->role,
                'password' => bcrypt($this->password),
            ]);
        }

        session()->flash('message', $this->userId ? 'Usuario actualizado.' : 'Usuario creado.');

        // Emitir evento para actualizar la tabla
        $this->emit('userUpdated');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.user-modal');
    }
}
