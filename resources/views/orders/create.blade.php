@extends('layout.master')

@section('title','Create New Order')

@section('content')


    @include('orders.form',[ 'action' => route('orders.store') ])
@endsection
