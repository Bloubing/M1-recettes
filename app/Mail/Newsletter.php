<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Recipe;
class Newsletter extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */
    public function __construct()
    {
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Newsletter',
            from: 'admin@lvm.net'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //Envoie les nouvelles recettes de la semaine
        return new Content(
            view: 'mail.newsletter',
            with: [
                'recipes' => Recipe::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->where('status', 'published')
                    ->get(),
            ]
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
