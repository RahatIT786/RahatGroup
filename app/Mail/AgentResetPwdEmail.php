<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AgentResetPwdEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $agent;

    /**
     * Create a new message instance.
     */
    public function __construct($url, $agent)
    {
        $this->url = $url;
        $this->agent = $agent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Your Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'agent.emails.agent_reset_password',
            with: [
                'url' => $this->url,
                'agent' => $this->agent,
            ],
        );
    }
}
