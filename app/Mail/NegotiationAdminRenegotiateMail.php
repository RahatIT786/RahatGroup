<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class NegotiationAdminRenegotiateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $negotiated_cost, $adminSetting, $adminwhatsapp;
    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, $adminSetting, $adminwhatsapp)
    {
        $this->booking = $booking;
        $this->negotiated_cost = $booking->negotiated_cost;
        $this->adminSetting = $adminSetting;
        $this->adminwhatsapp = $adminwhatsapp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Negotiation Amount Regenerated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.emails.agent_negotiation_admin_renegotiate',
            with: [
                'booking' => $this->booking,
                'negotiated_cost' => $this->negotiated_cost, // Pass the negotiated cost to the view
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
