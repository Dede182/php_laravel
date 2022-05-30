<?php

use App\Http\Controllers\firstController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { 
    return view('welcome',["name"=>"hsh","age"=>12]);
})->name("home"); 


Route::get("user/{name?}",function($name = null){
    return "i am user no ${name}"; 
});


Route::get("calc/{firstInt}/{secInt}",function($firstInt,$secInt){
    return $firstInt + $secInt;
});


Route::get('about-us',function(){
    return view('about');
})->name("about");

Route::view("content-me","content")->name("content");


Route::get("exchange-from/{amount}/to/{currency}",function($amount,$currency){
    $rates = Http::get('http://forex.cbm.gov.mm/api/latest')->object()->rates;
        $strtofloat = str_replace(',','',$rates->{strtoupper($currency)});
         return $amount * $strtofloat;
});


Route::get("exchange-to/{amount}/MMK/to/{currency}",function($amount,$currency){
    $rates = Http::get('https://forex.cbm.gov.mm/api/latest')->object()->rates;
    $strtofloat = str_replace(',','',$rates->{strtoupper($currency)});
         return round($amount / $strtofloat,3);
});

Route::post('/exchange-rate',[firstController::class,'exchange'])->name('exchange');
// Route::get("exchange/from/{amount}/{fromCurrency}/to/{toCurrency}",[firstController::class,'exchange']);
Route::view('/exchange-calculator','welcome');
Route::view('/result','result');