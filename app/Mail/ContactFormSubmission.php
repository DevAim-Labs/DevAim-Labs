<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public bool $isCheck;

    public function __construct(public array $data)
    {
        $this->isCheck = ($data['type'] ?? 'contact') === 'website_check';
    }

    public function envelope(): Envelope
    {
        $who = filled($this->data['name'] ?? null) ? $this->data['name'] : $this->data['email'];

        return new Envelope(
            subject: $this->isCheck
                ? 'Website-check aanvraag: '.($this->data['scan_url'] ?? $who)
                : 'Contactformulier: '.$who,
            replyTo: [$this->data['email']],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            text: 'emails.contact-text',
        );
    }
}
