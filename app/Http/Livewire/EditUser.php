<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public $parentName;
    public $user;

    protected $rules = [
        'user.id' => 'required',
        'user.name' => 'required|min:6',
        'user.email' => 'required|email',
    ];

    public function mount($parentName, User $user)
    {
        $this->parentName = $parentName;
        $this->user = $user;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData = data_get($validatedData, 'user');
        $this->closeModalWithEvents([
            $this->parentName => ['updateUser', [$validatedData]],
        ]);

    }

    public function render()
    {
        return view('livewire.edit-user');
    }
}
