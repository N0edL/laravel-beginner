<?php

namespace App\Livewire;

use App\Mail\ContactMeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;
    public $honeypot;

    public $timestamp;
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email:filter,rfc,dns|min:3|max:255',
        'message' => 'required|string|min:10|max:1000'
    ];

    protected $messages = [
        'honeypot.max' => 'Spam detected. Please try again.',
    ];

    protected $except = [
        'honeypot',
        'timestamp'
    ];

    public function mount()
    {
        $this->timestamp = now()->timestamp;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function send(){
        if (!empty($this->honeypot)) {
            Log::warning('Potential bot submission detected (honeypot)');
            session()->flash('success', 'Your message has been sent successfully!');
            return;
        }

        if ((now()->timestamp - $this->timestamp) < 3) {
            Log::warning('Potential bot submission detected (time-based)');
            // Pretend success but don't process
            session()->flash('success', 'Your message has been sent successfully!');
            return;
        }

        $validated = $this->validate();

        $messageId = Str::uuid();

        // $validated['name'] = strip_tags($validated['name']);
        // $validated['message'] = strip_tags($validated['message']);

        try {
            $sanitizedData = [
                'name' => htmlspecialchars($validated['name'], ENT_QUOTES, 'UTF-8'),
                'email' => filter_var($validated['email'], FILTER_SANITIZE_EMAIL),
                'message' => htmlspecialchars($validated['message'], ENT_QUOTES, 'UTF-8'),
                'message_id' => $messageId,
                'ip' => request()->ip(),
            ];

            $toEmail = config('mail.from.address');

            Mail::to($toEmail)
                ->send(new ContactMeMail($sanitizedData));

            Log::info("Contact form submitted", ['message_id' => $messageId]);

            $this->reset(['name', 'email', 'message']);
            $this->resetValidation();
            $this->timestamp = now()->timestamp;

            session()->flash('success', 'Your message has been sent successfully!');
        } catch (\Throwable $e) {
            Log::error("Contact form error: " . $e->getMessage(), [
                'message_id' => $messageId,
                'exception' => get_class($e),
            ]);

            session()->flash('error', 'There was a problem sending your message. Please try again later.');
        }
    }
    public function render()
    {
        return view('livewire.contact-form');
    }
}
