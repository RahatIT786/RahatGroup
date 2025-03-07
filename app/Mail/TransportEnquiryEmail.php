<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TransportEnquiryEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $transportEnquiry;
    public $randomstaff;
    public $sector_name,$adminSetting,$adminwhatsapp;


    /**
     * Create a new message instance.
     */
    public function __construct($transportEnquiry, $randomstaff, $adminSetting, $adminwhatsapp)
    {
        $this->transportEnquiry = $transportEnquiry;
        $this->randomstaff = $randomstaff;
        $this->sector_name = $transportEnquiry->carsectormaster->sector_name;
        // dd($this->sector_name);
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received Inquiry - Transport',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.transport_enquiry_mail',
            with: [
                'transportEnquiry' => $this->transportEnquiry,
                'randomstaff' => $this->randomstaff,
                'sector_name' => $this->sector_name,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
