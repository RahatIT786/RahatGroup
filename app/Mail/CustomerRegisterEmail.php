<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CustomerRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $mobile,$adminSetting,$adminwhatsapp;

    /**
     * Create a new message instance.
     */
    public function __construct($customer, $randomstaff, $mobile,$adminSetting,$adminwhatsapp)
    {
        $this->customer = $customer;
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
            view: 'user-front.emails.customer_register_mail',
            with: [
                'customer' => $this->customer,
                'mobile' => $this->mobile,
                'adminSetting' => $this->adminSetting,
                'adminwhatsapp' => $this->adminwhatsapp,
            ],
        );
    }
}
