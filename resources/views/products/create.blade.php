@extends('layout.master')

@section('title','Create New Product')

@section('content')
    @include('products.form',[ 'action' => route('products.store') ])
@endsection
