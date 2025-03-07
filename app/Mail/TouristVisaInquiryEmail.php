<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TouristVisaInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $touristvisa;
    public $countryname;
    public $randomstaff, $adminSetting, $adminwhatsapp;


    /**
     * Create a new message instance.
     */
    public function __construct($touristvisa, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->touristvisa = $touristvisa;
        $this->countryname = $touristvisa->country->countryname;
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
            subject: 'Received Inquiry -Tourist Visa',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.tourist_visa_inquiry_mail',
            with: [
                'touristvisa' => $this->touristvisa,
                'randomstaff' => $this->randomstaff,
                'countryname' => $this->countryname,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }
}
