<?php

namespace App\Console\Commands;

use App\Models\customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FillRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill redis DB from mysql DB';

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
                Redis::set('national_'.$customer->national_id, $customer->id);
            }
        }
    }
}
