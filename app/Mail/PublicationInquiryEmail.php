<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PublicationInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $publicationData;
    public $randomstaff,$adminSetting,$adminwhatsapp;

    /**
     * Create a new message instance.
     */
    public function __construct($publicationData, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->publicationData = $publicationData;
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
            subject: 'Received Inquiry - Publication',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.publication_inquiry_mail',
            with: [
                'publicationData' => $this->publicationData,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
