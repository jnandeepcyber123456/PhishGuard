<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Recipient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class PhishingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Campaign $campaign;
    public Recipient $recipient;
    public string $trackingUrl;

    public function __construct(Campaign $campaign, Recipient $recipient)
    {
        $this->campaign   = $campaign;
        $this->recipient  = $recipient;
        $this->trackingUrl = route('track', $recipient->token);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->campaign->sender_email, $this->campaign->sender_name),
            subject: $this->campaign->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.phishing',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}