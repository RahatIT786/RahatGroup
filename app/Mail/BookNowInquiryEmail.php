<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BookNowInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingenquiry,$adminSetting,$adminwhatsapp;
    public $randomstaff;


    /**
     * Create a new message instance.
     */
    public function __construct($bookingenquiry, $randomstaff , $adminSetting, $adminwhatsapp)
    {
        $this->bookingenquiry = $bookingenquiry;
        $this->randomstaff = $randomstaff;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry - Booking',
        );
    }



    public function content(): Content
    {
        return new Content(
            view: 'user.emails.book_now_inquiry_mail',
            with: [
                'bookingenquiry' => $this->bookingenquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
