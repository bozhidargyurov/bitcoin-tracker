<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BitcoinPriceRaisedEmail extends Mailable
{
    use Queueable, SerializesModels;

    private float $limit;
    private float $currentPrice;

    public function __construct(float $limit, float $currentPrice)
    {
        $this->limit = $limit;
        $this->currentPrice = $currentPrice;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'The BTC price has exceeded your limit',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())->htmlString(
            sprintf(
                'The price of BTC has exceeded the limit of %s USD. The current price is %s USD',
                number_format($this->limit, 2, '.', ''),
                number_format($this->currentPrice, 2, '.', '')
            )
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
