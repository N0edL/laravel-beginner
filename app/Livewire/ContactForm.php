<?php

namespace App\Livewire;

use App\Mail\ContactMeMail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
        'message' => 'required|string|min:10|max:1000',
    ];

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function send(){
        $validatedData = $this->validate();

        try {
            Mail::to(users: $validatedData['email'])->send(new ContactMeMail($validatedData));

            session()->flash('success', 'Your message has been sent successfully!');
        } catch (\Throwable $th) {
            session()->flash('error', 'There was an error sending your message. Please try again later.');
        }

        $this->reset();
    }
}
