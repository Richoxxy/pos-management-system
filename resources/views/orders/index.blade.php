@extends('layout.master')
@section('title','List of orders')

@section('content')

{{-- <div class="d-flex justify-content-center"> --}}
  <a class="btn btn-lg btn-primary mb-3" href="{{route('orders.create')}}" >Add New Order</a>
{{-- </div> --}}

<table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Name</th>
        <th scope="col">No. of Products</th>
        <th scope="col">Products</th>

        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <th scope="row"> {{ $order->id }} </th>
        <td>{{ $order->name }}</td>
        <td>{{ $order->products->count() }}</td>
        <td>
            @foreach ($order->products as $product)
                <span>{{$product->name}}</span>
            @endforeach
        </td>

        <td>
            <a href="{{route('orders.show', $order->id)}}" class="btn btn-outline-primary">View</a>
            <a href="{{route('orders.edit', $order->id)}}" class="btn btn-outline-success">Edit</a>
            @if($order->trashed())
            <x-deletebutton :action="route('orders.destroy', $order->id)" label="Force Delete"  />
            @else
            <x-deletebutton :action="route('orders.destroy', $order->id)"  />
            @endif
        </td>
      </tr>
      @endforeach


    </tbody>
  </table>
  {{ $orders->links()}}
  @endsection
