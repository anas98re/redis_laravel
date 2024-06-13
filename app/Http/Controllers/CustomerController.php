<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Http\Requests\StorecustomerRequest;
use App\Http\Requests\UpdatecustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CustomerController extends Controller
{
    public function checkCustomer(Request $request)
    {
        $customer_id = Customer::where('national_id', $request->national_id)->first(); // take 2.85 seconds

        // $customer_id = Redis::get('national_' . $request->national_id); // but this take 287 ms

        if ($customer_id) {

            Customer::where('id', $customer_id)->update($request->all());
        } else {
            
            Customer::create($request->all());
        }
    }
}
