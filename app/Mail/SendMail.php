<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $data,
        public ?UploadedFile $file = null,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address(config('mail.from.address'), config('mail.from.name'))],
            cc: $this->data['cc'] ?? [],
            bcc: $this->data['bcc'] ?? [],
            subject: $this->data['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.standard',
            text: 'emails.standard-text',
            with: [
                'recipientName' => $this->data['recipient_name'] ?? null,
                'body'          => $this->data['message'],
                'senderName'    => config('mail.from.name'),
            ],
        );
    }

    public function attachments(): array
    {
        if (! $this->file) {
            return [];
        }

        return [
            Attachment::fromPath($this->file->getRealPath())
                ->as($this->file->getClientOriginalName())
                ->withMime($this->file->getClientMimeType()),
        ];
    }
}
