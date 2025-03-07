<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class RamzanPackagesInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ramzanpackages;
    public $city_name;
    public $flight_name;
    public $package_type;
    public $randomstaff;



    /**
     * Create a new message instance.
     */
    public function __construct($ramzanpackages, $randomstaff)
    {
        $this->ramzanpackages = $ramzanpackages;
        $this->randomstaff = $randomstaff;
        $this->city_name = $ramzanpackages->city->city_name;
        $this->flight_name = $ramzanpackages->flight->flight_name;
        $this->package_type = $ramzanpackages->packagetype->package_type;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry -RamzanPackages',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.ramzan_packages_inquiry_mail',
            with: [
                'ramzanpackages' => $this->ramzanpackages,
                'randomstaff' => $this->randomstaff,
                'city_name' => $this->city_name,
                'flight_name' => $this->flight_name,
                'package_type' => $this->package_type,
            ],
        );
    }
}
