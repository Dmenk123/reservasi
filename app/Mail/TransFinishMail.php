<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransFinishMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($collection)
    {
        $this->details = $collection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Identity by Cipto Djunaedy')
                    ->view('email.notif_transaksi_selesai', ['detail' => $this->details]);
    }
}
