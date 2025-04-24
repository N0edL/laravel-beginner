<?php

namespace App\Livewire;

use App\Mail\ContactMeMail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;
    public $honeypot;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|min:3|max:255',
        'message' => 'required|string|min:10|max:1000',
        'honeypot' => 'max:0',
    ];

    protected $messages = [
        'honeypot.max' => 'Spam detected. Please try again.',
    ];

    protected $except = [
        'honeypot',
    ];

    public function mount()
    {
        csrf_token();
    }

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

        if (!empty($this->honeypot)) {
            session()->flash('error', 'Spam detected. Please try again.');
            return;
        }

        if (session()->has('last_contact_attempt') &&
            time() - session('last_contact_attempt') < 30) {
            session()->flash('error', 'You are sending messages too quickly. Please wait a moment.');
            return;
        }

        $validatedData['name'] = strip_tags($validatedData['name']);
        $validatedData['message'] = strip_tags($validatedData['message']);

        try {
            session()->put('last_contact_attempt', time());

            $toEmail = config('mail.from.address');

            Mail::to($toEmail)->send(new ContactMeMail($validatedData));


            Mail::to(users: $validatedData['email'])->send(new ContactMeMail([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'message' => 'Thank you for contacting us. We will get back to you soon.',
            ]));

            session()->flash('success', 'Your message has been sent successfully. We will get back to you soon.');

        } catch (\Throwable $th) {
            session()->flash('error', 'There was an error sending your message. Please try again later.');
        }

        $this->reset(['name', 'email', 'message', 'honeypot']);
    }
}
