<?php

namespace App\Livewire;

use App\Mail\ContactMeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class ContactForm extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public $name = '';

    #[Validate('required|email:filter,rfc,dns|min:3|max:255')]
    public $email = '';

    #[Validate('required|string|min:10|max:1000')]
    public $message = '';

    public $honeypot = '';
    public $timestamp;
    public $isSubmitting = false;

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'name.min' => 'Your name must be at least 3 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please enter your message.',
        'message.min' => 'Your message must be at least 10 characters.',
        'message.max' => 'Your message cannot exceed 1000 characters.',
    ];

    public function mount()
    {
        $this->timestamp = now()->timestamp;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function send()
    {
        // Prevent double submission
        if ($this->isSubmitting) {
            return;
        }

        $this->isSubmitting = true;

        // Anti-spam checks
        if (!empty($this->honeypot)) {
            Log::warning('Potential bot submission detected (honeypot)', [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
            session()->flash('success', 'Your message has been sent successfully!');
            $this->isSubmitting = false;
            return;
        }

        if ((now()->timestamp - $this->timestamp) < 3) {
            Log::warning('Potential bot submission detected (time-based)', [
                'ip' => request()->ip(),
                'submission_time' => now()->timestamp - $this->timestamp
            ]);
            session()->flash('success', 'Your message has been sent successfully!');
            $this->isSubmitting = false;
            return;
        }

        $this->validate();

        $messageId = Str::uuid();

        try {
            $sanitizedData = [
                'name' => htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8'),
                'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),
                'message' => htmlspecialchars($this->message, ENT_QUOTES, 'UTF-8'),
                'message_id' => $messageId,
                'ip' => request()->ip(),
            ];

            // Use config for admin email, fallback to env
            $adminEmail = env('MAIL_ADMIN_ADDRESS', 'info@noedl.xyz');


            // Send notification to admin
            Mail::to($adminEmail)->send(new ContactMeMail(data: $sanitizedData));

            // Send confirmation to user
            Mail::to($sanitizedData['email'])->send(new \App\Mail\ContactConfirmationMail($sanitizedData));

            Log::info("Contact form submitted successfully", [
                'message_id' => $messageId,
                'sender_email' => $this->email,
                'sender_name' => $this->name
            ]);

            $this->reset(['name', 'email', 'message']);
            $this->resetValidation();
            $this->timestamp = now()->timestamp;

            session()->flash('success', 'Thank you! Your message has been sent successfully. I\'ll get back to you soon.');

        } catch (\Throwable $e) {
            Log::error("Contact form submission failed", [
                'message_id' => $messageId,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'sender_email' => $this->email ?? 'unknown',
            ]);

            session()->flash('error', 'Oops! There was a problem sending your message. Please try again or contact me directly.');
        }

        $this->isSubmitting = false;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
