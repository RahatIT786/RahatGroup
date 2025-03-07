<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class QuickEnquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $quickEnquiry;
    public $randomstaff, $adminSetting, $adminwhatsapp;

    /**
     * Create a new message instance.
     */
    public function __construct($quickEnquiry, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->quickEnquiry = $quickEnquiry;
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
            subject: 'Received Inquiry -quickEnquiry',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.quick_enquiry_mail',
            with: [
                'quickEnquiry' => $this->quickEnquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,


            ],
        );
    }
}
