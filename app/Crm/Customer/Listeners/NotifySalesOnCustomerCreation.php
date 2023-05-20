<?php

namespace Crm\Customer\Listeners;

use Crm\Customer\Events\CustomerCreation;
//use Events\CustomerCreation;

class NotifySalesOnCustomerCreation
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
//        dd($customer);
    }
}
