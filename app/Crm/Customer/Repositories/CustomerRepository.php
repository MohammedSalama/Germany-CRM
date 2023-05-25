<?php

namespace Crm\Customer\Repositories;

use Crm\Base\Repositories\Repository;
use Crm\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository extends Repository
{
    /**
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->setModel($customer);
    }

    public function customerAnalytics(): array
    {
        //
        return [];
    }

}
