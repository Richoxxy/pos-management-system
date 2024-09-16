<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
      if(Auth::user()->isSuperAdmin()){
        $orders = Order::withTrashed()->simplePaginate(10);

      } else {
          $orders = Order::simplePaginate(10);
      }

       return view('orders.index',[
        'orders' => $orders,
       ]);
    }


    public function create()
    {
        $products = Product::all();
        return view('orders.create',[
            "order" => new Order,
            'products' => $products
    ]);
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|unique:orders|max:150|min:4',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id'
        ]);

        $order = Order::create($data);

        $order->products()->sync($data['product_id']);

        return redirect()->route('orders.index');


    }


    public function show(string $id)
    {

        //
    }

    public function edit(Order $order)
    {

        $products = Product::all();
        return view('orders.edit',[ "order" => $order, 'products' => $products ]);

    }


    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'name' => "required|unique:orders,id,{$order->id}|max:150|min:4",
             'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id'
        ]);

        $order->update($data);
        $order->products()->sync($data['product_id']);

        return redirect()->route('orders.index');

    }


    public function destroy(string $id)
    {
        $order = Order::withTrashed()->find($id);

        if ($order->trashed()){
            $order->products()->sync([]);
            $order->forceDelete();
        }else{
            $order->delete();
        }

        return redirect()->route('orders.index')
        ->with('alertMessage',"Order {$order->name} deleted successfully")->with('type', 'success');
    }
}
