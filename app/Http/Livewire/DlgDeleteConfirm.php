<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DlgDeleteConfirm extends ModalComponent
{
    public $parentName;
    public $data;

    public function mount($parentName, $data)
    {
        $this->parentName = $parentName;
        $this->data = $data;
    }

    public function confirmed()
    {
        $this->closeModalWithEvents([
            $this->parentName => ['confirmedDelete', [$this->data]],
        ]);
    }

    public function render()
    {
        return view('livewire.dlg-delete-confirm');
    }
}
