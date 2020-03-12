<?php

namespace App\Mail\Users;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PembayaranLayananMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data, $bank, $rekening;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $bank, $rekening)
    {
        $this->data = $data;
        $this->bank = $bank;
        $this->rekening = $rekening;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $bank = $this->bank;
        $rekening = $this->rekening;
        $invoice = '#INV/' . Carbon::parse($this->data->created_at)->format('Ymd') . '/' . $this->data->id;

        return $this->subject('Menunggu Pembayaran ATM/Transfer Bank ' . $this->bank . ' untuk Pesanan ' . $invoice)
            ->from(env('MAIL_USERNAME'), env('APP_TITLE'))
            ->view('emails.users.pembayaran-layanan', compact('data', 'bank', 'rekening', 'invoice'));
    }
}
