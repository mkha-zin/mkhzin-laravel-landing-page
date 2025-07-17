<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OffersEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $offerUrl;
    public string $offerImageUrl;
    public string $unsubscribeUrl;
    public string $emailSubject;
    public string $offerDescription;

    /**
     * Create a new message instance.
     */
    public function __construct(string $offerUrl, string $offerImageUrl, string $unsubscribeUrl, string $emailSubject, string $offerDescription)
    {
        $this->offerUrl = $offerUrl;
        $this->offerImageUrl = $offerImageUrl;
        $this->unsubscribeUrl = $unsubscribeUrl;
        $this->emailSubject = $emailSubject;
        $this->offerDescription = $offerDescription;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.offers_email',
            with: [
                'offerUrl' => $this->offerUrl,
                'offerImageUrl' => $this->offerImageUrl,
                'unsubscribeUrl' => $this->unsubscribeUrl,
                'emailSubject' => $this->emailSubject,
                'offerDescription' => $this->offerDescription,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
