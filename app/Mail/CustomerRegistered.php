<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;

class CustomerRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->view('emails.customer_registered')
                    ->with([
                        'customerName' => $this->customer->firstname . ' ' . $this->customer->lastname,
                        'customerEmail' => $this->customer->email,
                    ]);
    }
}
