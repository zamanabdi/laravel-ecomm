<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order; // This will be the array
    }

    public function build()
    {
        return $this->subject('Order Confirmation - #' . $this->order['id'])
                    ->view('emails.orders.placed');
    }
}
