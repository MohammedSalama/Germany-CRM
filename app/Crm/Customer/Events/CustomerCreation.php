<?php

declare(strict_types=1);

namespace Crm\Customer\Events;

use Crm\Customer\Models\Customer;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerCreation
{
    use Dispatchable;
    use SerializesModels;
    use InteractsWithSockets;

    /**
     * @var Customer
     */
    private Customer $customer;

    /**
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->setCustomer($customer);
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
