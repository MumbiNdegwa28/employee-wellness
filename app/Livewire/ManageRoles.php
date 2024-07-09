<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class ManageRoles extends Component
{
    public $users;
    public $roles;
    public $selectedUser;
    public $selectedRole;

    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function assignRole()
    {
        $this->validate([
            'selectedUser' => 'required|exists:users,id',
            'selectedRole' => 'required|exists:roles,id',
        ]);

        $user = User::find($this->selectedUser);
        $role = Role::find($this->selectedRole);

        if ($user && $role) {
            $user->roles()->syncWithoutDetaching([$role->id]);
            session()->flash('message', 'Role assigned successfully.');
        } else {
            session()->flash('error', 'User or role not found.');
        }
    }

    public function render()
    {
        return view('livewire.manage-roles');
    }
}
