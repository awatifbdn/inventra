<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use  Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderReceiptCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
         $this->order = $order;
        Log::info('Order sent to PDF:', ['order' => $this->order]);
    }

public function build()
    {
        $pdf = Pdf::loadView('emails.orders.receipt_pdf', ['order' => $this->order]);

        return $this->subject('Your Order Receipt')
                    ->view('emails.orders.receipt')
                    ->attachData($pdf->output(), 'receipt.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }

}
