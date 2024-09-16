<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index',[
            'products' => $products
        ]);

    }


    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $data = $request->input();
        Product::create($data);
        return redirect()->route('products.index');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(Product $product)
{
    $orders = Order::all(); // Fetch all orders for the selection

    return view('products.edit', compact('product', 'orders'));
}



public function update(Request $request, Product $product)
{
    // Validate the form input
    $data = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $product->update($data);

    // Sync the product's orders (many-to-many relationship)
    $product->orders()->sync($request->orders);

    // Redirect back with a success message
    return redirect()->route('products.index')->with('alertMessage', "Product {$product->name} updated successfully");
    }


    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('products.index')->with('alertMessage', "Product {$product->name} deleted successfully");
    }

}
