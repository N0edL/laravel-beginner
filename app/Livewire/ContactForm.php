<?php

namespace App\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
        'message' => 'required|string|min:10|max:1000',
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
