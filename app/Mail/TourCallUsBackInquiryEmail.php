<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TourCallUsBackInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $tourcallusback;
    public $randomstaff, $adminSetting, $adminwhatsapp;



    /**
     * Create a new message instance.
     */
    public function __construct($tourcallusback, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->tourcallusback = $tourcallusback;
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
            subject: 'Received Inquiry -TourCallUsBack',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.tour_call_us_back_inquiry_mail',
            with: [
                'tourcallusback' => $this->tourcallusback,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }
}
