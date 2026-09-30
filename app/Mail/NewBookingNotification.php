<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '👑 New Booking Received: #' . $this->booking->booking_reference . ' - ' . $this->booking->client_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_booking_notification',
            with: [
                'booking' => $this->booking,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        if ($this->booking->payment_proof) {
            // Check if file exists in public/storage
            $relative = ltrim(str_replace('/storage/', '', $this->booking->payment_proof), '/');
            $storagePath = storage_path('app/public/' . $relative);
            if (file_exists($storagePath)) {
                $attachments[] = Attachment::fromPath($storagePath)->as('Payment_Proof_' . $this->booking->booking_reference . '.' . pathinfo($storagePath, PATHINFO_EXTENSION));
            }
        }

        return $attachments;
    }
}
