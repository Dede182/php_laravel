@extends('master')
@section('title')Result @stop
@section('content')
    <div class="container ">
        <div class="">
             <p class = "d-inline">Your exchange from {{$amount}} {{$input}} to {{$output}} is </p>
            <h4 class = "d-inline" >{{$result}}</h4>
            <div class="d-flex justify-content-center">
                <a href="{{route('home')}}" class = " btn btn-outline-primary">Try more</a>
            </div>
        </div>
        <div class="my-4">
            <ul class = "list-group">
            @foreach ($record as $re )
             <li class = "list-group-item">   
                {{$re->input}} {{$re->amount}} = {{$re->result}} {{$re->output}}
            </li>   
            @endforeach
            </ul>
        </div>
        
    </div>  
@stop