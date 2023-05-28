<?php

namespace Crm\Customer\Services;

use Crm\Customer\Exceptions\InvalidExportFormat;
use Crm\Customer\Repositories\CustomerRepository;
use Crm\Customer\Services\Export\ExportInterface;


class CustomerExportService
{
    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param ExportInterface $exporter
     * @return void
     */
    public function export(ExportInterface $exporter)
    {
        $customer = $this->customerRepository->all();
        $exporter->export($customer->toArray());
    }
}
