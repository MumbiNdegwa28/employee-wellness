<div>
    <h2>Manage Roles</h2>
    <div>
        <label for="user">Select User:</label>
        <select wire:model="selectedUser" id="user">
            <option value="">-- Select User --</option>
            @foreach ($this->users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label for="role">Select Role:</label>
        <select wire:model="selectedRole" id="role">
            <option value="">-- Select Role --</option>
            @foreach ($this->roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    
    <button wire:click="assignRole">Assign Role</button>
    
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div>{{ session('error') }}</div>
    @endif
</div>
