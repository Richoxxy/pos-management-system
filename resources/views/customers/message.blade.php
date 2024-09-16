
<!DOCTYPE html>
<html>
<head>
    <title>Welcome </title>

</head>
<body>
    <div class="container">
        <h1>Welcome, <span class="highlight">{{ $customer->firstname }} {{ $customer->lastname }}</span>!</h1>

        <p>We're excited to welcome you to our school! You are now officially registered as a customer.</p>

        <p>Your Customer ID: <span class="highlight">{{ $customer->customer_id }}</span></p>

        <p>Your Order: <span class="highlight">{{ $customer->order->name }}</span></p>
        <p>Your Date of Birth: <span class="highlight">{{ $customer->dob }}</span></p>

        <p>Phone: <span class="highlight">{{ $customer->phone }}</span></p>

        <p>Thank you for joining us. We look forward to seeing you soon!</p>

        <button class="btn-primary" onclick="window.location.href='https://www.yourcompanywebsite.com'">View Our Website</button>
    </div>


</body>
</html>
