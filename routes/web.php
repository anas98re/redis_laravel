<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-redis', function () {
    try {
        Redis::set('test_key', 'test_value');
        $value = Redis::get('test_key');
        Redis::set('nat','4');
        Redis::set('nat','5');
        return Redis::get('nat');
        return 'Redis is working: ' . $value;
    } catch (\Exception $e) {
        return 'Redis is not working: ' . $e->getMessage();
    }
});
