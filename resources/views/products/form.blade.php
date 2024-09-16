
<form class="container-sm" action="{{$action}}" method="POST">
    <x-textfield name="name" label="Product Name" type="text"  placeholder="Enter a product name" />

    @csrf

    @isset($edit)
        @method('PATCH')
    @endisset

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
