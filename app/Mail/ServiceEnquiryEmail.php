<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ServiceEnquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $serviceEnquiry;
    public $randomstaff,$adminSetting,$adminwhatsapp;


    /**
     * Create a new message instance.
     */
    public function __construct($serviceEnquiry, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->serviceEnquiry = $serviceEnquiry;
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
            view: 'user-front.emails.service_enquiry_mail',
            with: [
                'serviceEnquiry' => $this->serviceEnquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
