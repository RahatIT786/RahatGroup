<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class HajjKitEnquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hajjkitEnquiry;
    public $randomstaff,$adminSetting,$adminwhatsapp;


    /**
     * Create a new message instance.
     */
    public function __construct($hajjkitEnquiry, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->hajjkitEnquiry = $hajjkitEnquiry;
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
            subject: 'Received Inquiry - Service',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.hajj_kit_enquiry_mail',
            with: [
                'hajjkitEnquiry' => $this->hajjkitEnquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
