@extends('layout.master')
@section('title','List of Products')

@section('content')

{{-- <div class="d-flex justify-content-center"> --}}
  <a class="btn btn-lg btn-primary mb-3" href="{{route('products.create')}}" >Add New Product</a>
{{-- </div> --}}

<table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>


      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <th scope="row"> {{ $product->id }} </th>
        <td>{{ $product->name }}</td>

        <td>
            <a href="{{route('products.show', $product->id)}}" class="btn btn-outline-primary">View</a>
            <a href="{{route('products.edit', $product->id)}}" class="btn btn-outline-success">Edit</a>
            <x-deletebutton :action="route('products.destroy', $product->id)"  />
        </td>
      </tr>
      @endforeach


    </tbody>
  </table>
  @endsection
