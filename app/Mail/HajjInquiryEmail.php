<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class HajjInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hajjpackage;
    public $city_name;
    public $flight_name;
    public $package_type;
    public $randomstaff, $adminSetting, $adminwhatsapp;



    /**
     * Create a new message instance.
     */
    public function __construct($hajjpackage, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->hajjpackage = $hajjpackage;
        $this->randomstaff = $randomstaff;
        $this->city_name = $hajjpackage->city->city_name??'';
        $this->flight_name = $hajjpackage->flight->flight_name ?? '';
        $this->package_type = $hajjpackage->packagetype->package_type;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -hajjpackages',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.hajj_inquiry_mail',
            with: [
                'hajjpackage' => $this->hajjpackage,
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
