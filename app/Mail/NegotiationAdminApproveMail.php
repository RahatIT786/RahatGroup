<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class NegotiationAdminApproveMail extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    public $status, $adminSetting, $adminwhatsapp;  // Approved or Rejected status

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, $adminSetting, $adminwhatsapp, $status)
    {
        $this->booking = $booking;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Negotiation ' . ucfirst($this->status),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        // dd($this->status);
        return new Content(
            view: 'admin.emails.agent_negotiation_admin_approve',
            with: [
                'booking' => $this->booking,
                'admin_email' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
                'status' => $this->status,
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
