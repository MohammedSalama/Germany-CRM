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
     * @param string $format
     * @return void
     * @throws InvalidExportFormat
     */
    public function export(string $format)
    {
        $customer = $this->customerRepository->all();

        $handler = config('export.exporter')[$format] ?? null;

//        dd($handler);

        if (! $handler) {
            throw new InvalidExportFormat(sprintf('format %s is not supported', $format));
        }

        $exporter = new $handler;

        if ($exporter instanceof ExportInterface) {
            $exporter->export($customer->toArray());
        }
    }
}
