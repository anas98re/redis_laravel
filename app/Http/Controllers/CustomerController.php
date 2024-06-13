<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CustomerController extends Controller
{
    public function checkCustomer(Request $request) //using redis
    {
        $customer_id = Customer::where('national_id', $request->national_id)->first(); //take 2.85 seconds

        // $customer_id = Redis::get('national_' . $request->national_id); // but this take 287 ms

        if ($customer_id) {

            Customer::where('id', $customer_id)->update($request->all());
        } else {

            Customer::create($request->all());
        }
    }

    public function checkCustomer2(Request $request) //using caching
    {

        $cacheKey = 'national_id_' . $request->national_id;
        $customer_id = Cache::get('national_id_123') ;
        $customer_id = Cache::remember($cacheKey, 300, function () use ($request) {
            return Customer::where('national_id', $request->national_id)->value('id');
        });
        // $customer_id = Customer::where('national_id', $request->national_id)->first(); //take 2.85 seconds

        if ($customer_id) {
            Customer::where('id', $customer_id)->update($request->all());
        } else {
            Customer::create($request->all());
        }
    }
}
