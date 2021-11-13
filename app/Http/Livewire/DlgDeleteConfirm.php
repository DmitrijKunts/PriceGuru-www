<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DlgDeleteConfirm extends ModalComponent
{
    public $parentName;
    public $data;
    public $bulk;

    public function mount($parentName, $data, $bulk)
    {
        $this->parentName = $parentName;
        $this->data = $data;
        $this->bulk = $bulk;
    }

    public function confirmed()
    {
        $this->closeModalWithEvents([
            $this->parentName => ['confirmedDelete', [$this->bulk, $this->data]],
        ]);
    }

    public function render()
    {
        return view('livewire.dlg-delete-confirm');
    }
}
