<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewBookingMail extends Mailable
{
    public function __construct(public Booking $booking)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'طلب خدمة جديد: '.$this->booking->service_title.' - '.$this->booking->name);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.new-booking');
    }
}
