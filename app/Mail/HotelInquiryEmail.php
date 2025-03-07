<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class HotelInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hotelenquiry;
    public $randomstaff;


    /**
     * Create a new message instance.
     */
    public function __construct($hotelenquiry, $randomstaff)
    {
        $this->hotelenquiry = $hotelenquiry;
        $this->randomstaff = $randomstaff;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -Hotel',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.hotel_inquiry_mail',
            with: [
                'hotelenquiry' => $this->hotelenquiry,
                'randomstaff' => $this->randomstaff,
            ],
        );
    }
}
