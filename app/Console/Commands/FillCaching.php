<?php

namespace App\Console\Commands;

use App\Models\customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class FillCaching extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-caching';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill caching DB from mysql DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $customer = customer::select('id','national_id')->get();

        if(asset($customer) && !empty($customer))
        {
            foreach($customer as $customer)
            {
                Cache::put('national_id_'.$customer->national_id, $customer->id);
            }
        }
    }
}
