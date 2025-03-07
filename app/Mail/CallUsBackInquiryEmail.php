<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CallUsBackInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $callusback;
    public $countryname;
    public $city_name;
    public $randomstaff,$adminSetting,$adminwhatsapp;

    /**
     * Create a new message instance.
     */
    public function __construct($callusback, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->callusback = $callusback;
        $this->countryname = $callusback->country->countryname;
        $this->city_name = $callusback->city->city_name;
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
            subject: 'Received Inquiry -CallusBack',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.call_us_back_inquiry_mail',
            with: [
                'callusback' => $this->callusback,
                'randomstaff' => $this->randomstaff,
                'countryname' => $this->countryname,
                'city_name' => $this->city_name,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
