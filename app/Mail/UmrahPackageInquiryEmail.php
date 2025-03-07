<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class UmrahPackageInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $umrahpackage;
    public $randomstaff;
    public $countryname;
    public $city_name,$adminSetting,$adminwhatsapp;

    /**
     * Create a new message instance.
     */
    public function __construct($umrahpackage, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->umrahpackage = $umrahpackage;
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
            subject: 'Received Inquiry - Customised Umrah',
        );
    }



    public function content(): Content
    {
        return new Content(
            view: 'user.emails.umrah_package_inquiry_mail',
            with: [
                'umrahpackage' => $this->umrahpackage,
                'randomstaff' => $this->randomstaff,
                'countryname' => $this->countryname,
                'city_name' => $this->city_name,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }
}
