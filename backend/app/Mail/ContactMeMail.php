<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ContactMeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    private $messageId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        // Only accept specified keys to prevent arbitrary data injection
        $this->data = array_intersect_key($data, array_flip(['name', 'email', 'message', 'message_id', 'ip', 'created_at']));
        $this->messageId = $data['message_id'] ?? null;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            return $this->subject('New Contact Form Submission')
                ->view('emails.admin')
                ->with([
                    'data' => $this->data
                ])
                ->withSymfonyMessage(function ($message) {
                    // Add headers for better tracking and security
                    $message->getHeaders()
                        ->addTextHeader('X-Message-ID', $this->messageId)
                        ->addTextHeader('X-Auto-Response-Suppress', 'All')
                        ->addTextHeader('X-Contact-Form', 'true');
                });
        } catch (\Exception $e) {
            Log::error("Failed to build contact form email: " . $e->getMessage(), [
                'message_id' => $this->messageId
            ]);
            throw $e;
        }
    }
}
