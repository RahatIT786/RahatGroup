<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TicketInquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketenquiry;
    public $city_name;
    public $flight_name;
    public $package_type,$adminSetting,$adminwhatsapp;
    public $randomstaff;



    /**
     * Create a new message instance.
     */
    public function __construct($ticketenquiry, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->ticketenquiry = $ticketenquiry;
        $this->randomstaff = $randomstaff;
        $this->city_name = $ticketenquiry->city->city_name;
        $this->flight_name = $ticketenquiry->flight->flight_name;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry PNR Ticket',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.emails.ticket_inquiry_mail',
            with: [
                'ticketenquiry' => $this->ticketenquiry,
                'randomstaff' => $this->randomstaff,
                'city_name' => $this->city_name,
                'flight_name' => $this->flight_name,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }
}
