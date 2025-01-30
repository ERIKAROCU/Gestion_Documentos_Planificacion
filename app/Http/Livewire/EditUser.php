<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $name, $dni, $email, $password, $password_confirmation, $is_active = 1, $role;
    public $userId, $user;

    protected $listeners = ['editUser' => 'loadUserData'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'dni' => 'required|numeric',
        'email' => 'required|email',
        'password' => 'nullable|string|min:8|confirmed',
        'is_active' => 'required|boolean',
        'role' => 'required|string|in:admin,employee',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->dni = $user->dni;
        $this->email = $user->email;
        $this->is_active = $user->is_active;
        $this->role = $user->role;
    }

    public function loadUserData($userId)
    {
        $this->reset();
        
        $user = User::findOrFail($userId);

        $this->name = $user->name;
        $this->dni = $user->dni;
        $this->email = $user->email;
        $this->is_active = $user->is_active;
        $this->role = $user->role;

        // Emitir evento para abrir el modal con Livewire
        $this->dispatchBrowserEvent('openEditModal');
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'dni' => $this->dni,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'role' => $this->role,
        ]);

        if (!empty($this->password)) {
            $user->password = bcrypt($this->password);
            $user->save();
        }

        session()->flash('message', 'Usuario actualizado exitosamente.');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.edit-user');
    }
}