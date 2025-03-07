<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class LaundryEnquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $laundryenquiry;
    public $randomstaff;

    /**
     * Create a new message instance.
     */
    public function __construct($laundryenquiry, $randomstaff)
    {
        $this->laundryenquiry = $laundryenquiry;
        $this->randomstaff = $randomstaff;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -Laundry',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.laundry_inquiry_mail',
            with: [
                'laundryenquiry' => $this->laundryenquiry,
                'randomstaff' => $this->randomstaff,

            ],
        );
    }
}
