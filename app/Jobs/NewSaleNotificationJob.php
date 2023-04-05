<?php

namespace App\Jobs;

use App\Mail\NewSaleMailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewSaleNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $saleId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($saleId)
    {
        $this->saleId = $saleId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('praveen@sparkouttech.com')
            ->cc(['rajadavid423@gmail.com', 'chandrikha@sparkouttech.com'])
            ->send(new NewSaleMailNotification($this->saleId));
    }
}
