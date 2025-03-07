<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class UmrahPackagesInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $umrahpackage;
    public $city_name;
    public $flight_name;
    public $package_type;
    public $randomstaff, $adminSetting, $adminwhatsapp;



    /**
     * Create a new message instance.
     */
    public function __construct($umrahpackage, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->umrahpackage = $umrahpackage;
        $this->randomstaff = $randomstaff;
        $this->city_name = $umrahpackage->city->city_name;
        $this->flight_name = $umrahpackage->flight->flight_name;
        $this->package_type = $umrahpackage->packagetype->package_type;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -UmrahPackages',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.umrah_packages_inquiry_mail',
            with: [
                'umrahpackage' => $this->umrahpackage,
                'randomstaff' => $this->randomstaff,
                'city_name' => $this->city_name,
                'flight_name' => $this->flight_name,
                'package_type' => $this->package_type,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }
}
