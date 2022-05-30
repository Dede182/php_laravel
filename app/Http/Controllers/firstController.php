<?php

namespace App\Http\Controllers;
use App\Models\jett;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class firstController extends Controller
{
    public function exchange(Request $request){
            
            $rates = Http::get("http://forex.cbm.gov.mm/api/latest")->object()->rates;
            $fromCurrencyRate = str_replace(",","",$rates->{strtoupper($request->fromCurrency)});
            $toCurrencyRate = str_replace(",","",$rates->{strtoupper($request->toCurrency)});

              //FromCurrency to mmk
            $mmk = $request->amount * $fromCurrencyRate;
            if($request->toCurrency == "MMK"){
                global $mmk;
                $result = $mmk;
            }

             //mmk to ToCurrency
            else{
               $result = round($mmk / $toCurrencyRate,2)." ".$request->toCurrency; 
            }
          
           $record = new jett();
           $record->input =$request->fromCurrency;
           $record->output =  $request->toCurrency;
           $record->amount=$request->amount;    
           $record->result = round($mmk / $toCurrencyRate,2); 
           $record->save();
            return view('result',[
                "input"=>$request->fromCurrency,
                "output"=>$request->toCurrency,
                "amount" =>$request->amount,
                "result" => $result,
                "record"=> $record->all()
            ]);
    }
}