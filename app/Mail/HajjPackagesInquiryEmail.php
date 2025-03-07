<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class HajjPackagesInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hajjpackages;
    public $city_name;
    public $flight_name;
    public $package_type;
    public $randomstaff, $adminSetting, $adminwhatsapp;



    /**
     * Create a new message instance.
     */
    public function __construct($hajjpackages, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->hajjpackages = $hajjpackages;
        $this->randomstaff = $randomstaff;
        $this->city_name = $hajjpackages->city->city_name;
        $this->flight_name = $hajjpackages->flight->flight_name;
        $this->package_type = $hajjpackages->packagetype->package_type;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -Hajj Packages',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.hajj_packages_inquiry_mail',
            with: [
                'hajjpackages' => $this->hajjpackages,
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
