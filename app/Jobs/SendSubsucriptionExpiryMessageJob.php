<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubsucriptionExpiryMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;
    private $expireDate;
    public function __construct($customer, $expireDate)
    {
        $this->customer = $customer;
        $this->expireDate = $expireDate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //send email
        info('im here in SendSubsucriptionExpiryMessageJob class');
        // $customrs = customer::get();
    }
}
