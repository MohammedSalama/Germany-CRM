<?php

namespace Crm\Customer\Listeners;

//use App\Events\CustomerCreation;
use Crm\Customer\Events\CustomerCreation;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerCreation $event): void
    {
        $customer = $event->getCustomer();
    }
}
