
<form class="container-sm" action="{{$action}}" method="POST">
    <x-textfield
    name="name"
    label="Order Name"
    type="text"
    :value="$order->name"
    placeholder="Enter a order name" />


    <h4>Select Products</h4>
    <div class="row row-cols-3 mb-3">
        @foreach($products as $product)
        <x-inputswitch :products="$order->products"  :label="$product->name" name="product_id[]" :value="$product->id" />
        @endforeach
    </div>

    @csrf
    @isset($edit)
        @method('PATCH')
    @endisset
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
