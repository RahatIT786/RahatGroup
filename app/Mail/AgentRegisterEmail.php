<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AgentRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent,$adminSetting,$adminwhatsapp;

    public $mobile;

    /**
     * Create a new message instance.
     */
    public function __construct($agent ,$mobile,$adminSetting,$adminwhatsapp)
    {
        $this->agent = $agent;

        $this->mobile = $mobile;
        $this->adminSetting = $adminSetting;
    $this->adminwhatsapp = $adminwhatsapp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration',
        );
    }



    public function content(): Content
    {
        return new Content(
            view: 'user.emails.agent_register_mail',
            with: [
                'agent' => $this->agent,
                'mobile' => $this->mobile,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,

            ],
        );
    }
}
