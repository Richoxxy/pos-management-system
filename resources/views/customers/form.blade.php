

<form class="container-sm" action="{{$action}}" method="POST" enctype="multipart/form-data">
    <div class="row g-3">
        <div class="col">
            <x-textfield name="firstname" label="Firstname" type="text" :value="$customer->firstname" placeholder="Enter customer firstname" />
        </div>
        <div class="col">
            <x-textfield name="lastname" :value="$customer->lastname" label="Lastname" type="text" placeholder="Enter customer lastname" />
        </div>
    </div>
    <div class="row g-3">
        <div class="col">
            <x-textfield name="customer_id" :value="$customer->customer_id" label="Customer ID" type="text" placeholder="Enter customer ID" />
        </div>
        <div class="col">
            <x-textfield name="email" :value="$customer->email" label="Customer Email" type="email" placeholder="Enter customer email" />
        </div>
    </div>
    <div class="row g-3">
        @isset($edit)
        <div class="col">
            <label for="">Current Image:</label>
            <img src="{{$customer->getImageURL()}}" alt="customer image" height="70" width="70">
        </div>
        @endisset
        <div class="col">
            <x-textfield name="image" :value="$customer->image" label="Customer Image" type="file" placeholder="Upload customer image" />
        </div>
    </div>


    @php
        $gender = [
            ['value'=>'male', 'label'=>'Male'],
            ['value'=>'female','label'=>'Female'],
        ];
    @endphp


    <x-select-field :options="$gender" name="gender" label="Select Gender" :value="$customer->gender" />

    <x-select-field :options="$orders" name="order_id" label="Select Order" :value="$customer->order_id"/>

    <x-textfield name="phonenumber" :value="$customer->phonenumber" label="Customer Phonenumber" type="tel" placeholder="Enter customer phonenumber" />

    <x-textfield name="dob" label="Customer DOB" :value="$customer->dob" type="date" placeholder="Enter customer date of birth" />

    @csrf

    @isset($edit)
        @method('PATCH')
    @endisset

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
