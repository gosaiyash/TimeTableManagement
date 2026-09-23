<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAttachmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $filePath;

    public function __construct($details, $filePath)
    {
        $this->details = $details;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->subject($this->details['title'])->subject($this->details['message'])
                    ->view('emails.attachment')
                    ->attach($this->filePath);

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Attachment Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin/readmail',
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
