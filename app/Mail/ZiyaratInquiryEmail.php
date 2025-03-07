<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ZiyaratInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ziyaratpackages;
    public $city_name;
    public $flight_name;
    public $package_type;
    public $randomstaff, $adminSetting, $adminwhatsapp;



    /**
     * Create a new message instance.
     */
    public function __construct($ziyaratpackages, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->ziyaratpackages = $ziyaratpackages;
        $this->randomstaff = $randomstaff;
        $this->city_name = $ziyaratpackages->city->city_name??'';
        $this->flight_name = $ziyaratpackages->flight->flight_name ?? '';
        $this->package_type = $ziyaratpackages->packagetype->package_type;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -ziyaratpackages',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.ziyarat_inquiry_mail',
            with: [
                'ziyaratpackages' => $this->ziyaratpackages,
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
