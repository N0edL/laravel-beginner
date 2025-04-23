<?php

namespace App\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required|max:500',
    ];

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function submitForm()
    {
        $this->validate();

        dd('Form Submitted', [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);
    }
}
