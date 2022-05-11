<?php

namespace App\Http\Livewire;

use App\Mail\Contact as MailContact;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $content;

    protected $rules = [
        'subject' => 'required|min:2',
        'name' => 'required|min:2',
        'email' => 'required|email',
        'content' => 'required|min:2',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $data = $this->validate();

        Mail::to(config('mail.contactAddress', "admin@admin.net"))->send(new MailContact($data));

        $this->reset();
        session()->flash('message', 'Ваше сообщение отправлено');
    }

    public function render()
    {
        return view('livewire.contact')->layout('layouts.app', ['title' => 'Обратная связь']);
    }
}
