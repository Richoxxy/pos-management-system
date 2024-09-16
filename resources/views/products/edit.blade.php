
@extends('layout.master')

@section('title','Edit '.$product->name)

@section('content')
    @include('products.form',[
        'action' => route('products.update', $product->id),
        'edit' => true ]
        )
@endsection
