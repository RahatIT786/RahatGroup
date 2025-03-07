<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ForexInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $forexenquiry;
    public $randomstaff,$adminSetting,$adminwhatsapp;


    /**
     * Create a new message instance.
     */
    public function __construct($forexenquiry, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->forexenquiry = $forexenquiry;
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
            subject: 'Received Inquiry -Forex',
        );
    }



    public function content(): Content
    {
        return new Content(
            view: 'user.emails.forex_inquiry_mail',
            with: [
                'forexenquiry' => $this->forexenquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
