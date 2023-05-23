<?php

namespace Crm\Note\Listeners;

//use App\Events\NoteCreation;
use Crm\Customer\Services\CustomerService;
use Crm\Note\Events\NoteCreation;

class SendProjectCreationEmail
{
    /**
     * @var CustomerService
     */
    private CustomerService $customerService;
    /**
     * Create the event listener.
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Handle the event.
     */
    public function handle(NoteCreation $event): void
    {
        $note = $event->getNote();
        $customer = $this->customerService->show($note->customer_id);
    }
}
