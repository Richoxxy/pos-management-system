<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Validation\Rule;
use App\Mail\CustomerRegistered;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    //

    public function index(Request $request)
    {
        // If you're filtering by a search query
        $search = $request->input('search');
        $customers = Customer::with('order')
                            ->where('firstname', 'like', "%{$search}%")
                            ->orWhere('lastname', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->paginate(10); // Paginate the results

        return view('customers.index', compact('customers')); // Return the view
    }

   public function show(string $id)
   {

       //
   }


   public function create(){
    $orders = Order::all(['id','name'])->map(function ($order) {
        return [
            'value' => $order->id,
            'label' => $order->name
        ];
    });

    return view('customers.create', [ 'orders' => $orders, 'customer' => new Customer ]);
   }


   public function store(Request $request)
   {
       $validator = $this->getValidationRules();
       $data = $request->validate($validator['rules'], $validator['messages'], $validator['attributes']);

       if ($request->hasFile('image')) {
           $data['image'] = $request->image->store('images');
       }

       $customer = Customer::create($data);

       // Send email to Mailtrap
       Mail::to('recipient@example.com')->send(new CustomerRegistered($customer));

       return redirect()->route('customers.index')->with('alertMessage', "Customer {$data['firstname']} added successfully");
   }


   public function edit(Customer $customer){
    $orders = Order::all(['id','name'])->map(function ($order) {
        return [
            'value' => $order->id,
            'label' => $order->name
        ];
    });
    return view('customers.edit', ['customer' => $customer, 'orders' => $orders]);
   }


   public function update(Request $request, Customer $customer){
        $validator = $this->getValidationRules($customer->id);
        $data = $request->validate($validator['rules'],$validator['messages'],$validator['attributes']);
        if ($request->hasFile('image')) {

            $data['image'] = $request->image->store('images');
        }

        $customer->update($data);
        return redirect()->route('customers.index')->with('alertMessage',"Customer {$data['firstname']} edited successfully");

   }

   public function destroy(Customer $customer)
   {

       $customer->delete();

       // Redirect back with a success message
       return redirect()->route('customers.index')->with('alertMessage', "Customer {$customer->name} deleted successfully");
   }

   private function getValidationRules($customerId = null) {
        $rules = [
            'firstname' => 'required|alpha|min:3|max:50',
            'lastname' => 'required|alpha|max:100|min:3',
            'dob' => 'required|before:2000-01-01',
            'order_id' => 'required|exists:orders,id',
            'gender' => 'required|in:male,female,other',
            'phonenumber' => 'required|numeric',
            'customer_id' => ['required','alpha_num'],
            'email' => ['required','email','max:150'],
            'image' => 'sometimes|image|max:1024'
        ];

        if ($customerId != null){
            $rules['email'][] =  Rule::unique('customers')->ignore($customerId);
        } else {
            $rules['email'][] = 'unique:customers';
            $rules['customer_id'][] = 'unique:customers';
        }

        $messages = [

            'gender.in' => 'Only "male", "female", and "other" are accepted',
            'order_id.required' => 'Please select an order',
            'image' => 'You can only upload images below 1MB',

        ];
        $attributes = [
             'dob' => 'date of birth',
            'order_id' => 'order'
        ];
        return ['rules' => $rules, 'messages' => $messages,'attributes' => $attributes];
   }

}
