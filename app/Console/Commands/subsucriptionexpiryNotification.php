<?php

namespace App\Console\Commands;

use App\Jobs\SendSubsucriptionExpiryMessageJob;
use App\Models\customer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class subsucriptionexpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subsucriptionexpiry-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customrs = customer::get();
        foreach($customrs as $custom)
        {
            info('im here in subsucriptionexpiryNotification class');

            $expireDate = 'hi';
            dispatch(new SendSubsucriptionExpiryMessageJob($custom, $expireDate));
        }

        //dispatch is a helper methode for job

    }
}
