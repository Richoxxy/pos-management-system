@extends('layout.master')

@section('title','Create New Customer')

@section('content')
    @include('customers.form',[ 'action' => route('customers.store') ])
@endsection
