<?php

namespace Crm\Invoice\Listeners;

//use App\Events\InvoiceCreation;
use Crm\Customer\Services\CustomerService;
use Crm\Invoice\Events\InvoiceCreation;

class SendInvoiceCreationEmail
{
    /**
     * @var CustomerService
     */
    private CustomerService $customerService;

    /**
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Handle the event.
     */
    public function handle(InvoiceCreation $event): void
    {
        $invoice = $event->getInvoice();
        $customer = $this->customerService->show($invoice->customer_id);
    }
}
