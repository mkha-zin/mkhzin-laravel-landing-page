<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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

    /**
     * Create a new message instance.
     */
    public function __construct(string $offerUrl, string $offerImageUrl, string $unsubscribeUrl, string $emailSubject)
    {
        $this->offerUrl = $offerUrl;
        $this->offerImageUrl = $offerImageUrl;
        $this->unsubscribeUrl = $unsubscribeUrl;
        $this->emailSubject = $emailSubject;
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
