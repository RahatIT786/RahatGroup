<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CustomerResetPwdEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $customer;

    /**
     * Create a new message instance.
     */
    public function __construct($url, $customer)
    {
        $this->url = $url;
        $this->customer = $customer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Your Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.customer_reset_password',
            with: [
                'url' => $this->url,
                'customer' => $this->customer,
            ],
        );
    }
}
