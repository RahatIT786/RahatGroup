<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AssistantEnquiryEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $assistantenquiry,$adminSetting,$adminwhatsapp;
    public $randomstaff;

    /**
     * Create a new message instance.
     */
    public function __construct($assistantenquiry, $randomstaff , $adminSetting, $adminwhatsapp)
    {
        $this->assistantenquiry = $assistantenquiry;
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
            subject: 'Received Assistant Enquiry',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.assistant_inquiry_mail',
            with: [
                'assistantenquiry' => $this->assistantenquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
