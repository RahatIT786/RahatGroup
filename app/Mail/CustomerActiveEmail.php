<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CustomerActiveEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    // public $pass;

    /**
     * Create a new message instance.
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
        // $this->pass = $pass;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Active',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.customer_active_mail',
            with: [
                'customer' => $this->customer,
                // 'pass' => $this->pass,
            ],
        );
    }
}
