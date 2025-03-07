<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;

class NewsLetterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $imagePath;

   /**
     * Create a new message instance.
     *
     * @param string $imagePath
     * @return void
     */
    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Received - Newsletter',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'user-front.emails.news_letter_mail',
            with: [
                'image_path' => $this->imagePath,
            ],
        );
    }

    public function build()
    {
        return $this->view('user-front.emails.news_letter_mail')
                    ->attach(
                        Storage::disk('public')->path($this->imagePath),
                        [
                            'as' => basename($this->imagePath),
                            'mime' => mime_content_type(Storage::disk('public')->path($this->imagePath)),
                        ]
                    );
    }

}
