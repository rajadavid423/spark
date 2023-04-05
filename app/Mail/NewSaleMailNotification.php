<?php

namespace App\Mail;

use App\Models\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSaleMailNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $saleId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($saleId)
    {
        $this->saleId = $saleId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sale = Sale::with('customer', 'employee', 'saleDetails.category', 'saleDetails.product')->find($this->saleId);

        return $this->from('rajadavid2108@gmail.com', 'Raja Manoharan')
            ->subject('New Sale Notification - Interview Task (Raja)')
            ->view('email.new_sale_notification')->with('data', $sale);
    }
}
