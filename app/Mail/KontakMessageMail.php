<?php
// app/Mail/KontakMessageMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\KontakMessage;

class KontakMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kontakMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(KontakMessage $kontakMessage)
    {
        $this->kontakMessage = $kontakMessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan Kontak: ' . $this->kontakMessage->subjek,
            replyTo: [$this->kontakMessage->email => $this->kontakMessage->nama],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.kontak-message',
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
