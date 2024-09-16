@extends('layout.master')

@section('title','Edit Details')

@section('content')
    @include('customers.form',[ 'action' => route('customers.update', $customer->id), 'edit' => true ])
@endsection
