<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerHotelInquiryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $hotelenquiry,$adminSetting,$adminwhatsapp;
    public $randomstaff;

    /**
     * Create a new message instance.
     */
    public function __construct($hotelenquiry, $randomstaff , $adminSetting, $adminwhatsapp)
    {
        $this->hotelenquiry = $hotelenquiry;
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
            subject: 'Received Inquiry -Hotel',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.hotel_inquiry_mail',
            with: [
                'hotelenquiry' => $this->hotelenquiry,
                'randomstaff' => $this->randomstaff,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
