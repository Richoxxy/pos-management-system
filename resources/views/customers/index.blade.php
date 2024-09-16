@extends('layout.master')
@section('title','List of Customers')

@section('content')

{{-- <div class="d-flex justify-content-center"> --}}
  <a class="btn btn-lg btn-primary mb-3" href="{{route('customers.create')}}" >Add New Customer</a>
{{-- </div> --}}
<form class="row flex g-3 justify-content-center"  action="{{route('customers.index')}}" method="GET" >
  <div class="col">
    <x-textfield value="" label="Search for a customer" name="search" type="text" placeholder="Enter name or email" />
  </div>
  <div class="col">
    <button class="btn btn-success" type="submit">Search</button>
  </div>
</form>

<table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">Customer ID</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Gender</th>
        <th scope="col">DOB</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Email</th>
        <th scope="col">Image</th>
        <th scope="col">Order</th>
        <th scope="col">Order ID</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($customers as $customer)
      <tr>
        <th scope="row"> {{ $customer->customer_id }} </th>
        <td>{{ $customer->firstname }}</td>
        <td>{{ $customer->lastname }}</td>
        <td>{{ $customer->gender }}</td>
        <td>{{ $customer->dob }}</td>
        <td>{{ $customer->phonenumber }}</td>
        <td>{{ $customer->email }}</td>
        <td>
          <img src="{{$customer->getImageURL()}}" alt="" height="70" width="70">
        </td>
        <td>{{ $customer->order->name }}</td>
        <td>{{ $customer->order_id }}</td>
        <td>
            <a href="{{route('customers.show', $customer->id)}}" class="btn btn-outline-primary">View</a>
            <a href="{{route('customers.edit', $customer->id)}}" class="btn btn-outline-success">Edit</a>
            <x-deletebutton :action="route('customers.destroy', $customer->id)"  />
        </td>
      </tr>
      @endforeach


    </tbody>
  </table>

  {{ $customers->links()}}
  @endsection
