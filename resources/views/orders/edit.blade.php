
@extends('layout.master')

@section('title','Edit '.$order->name)

@section('content')
    @include('orders.form',[
        'action' => route('orders.update', $order->id),
        'edit' => true ]
        )
@endsection
