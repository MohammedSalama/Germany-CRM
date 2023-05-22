<?php

namespace Crm\Project\Listeners;

//use App\Events\ProjectCreation;
use Crm\Customer\Services\CustomerService;
use Crm\Project\Events\ProjectCreation;

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
    public function handle(ProjectCreation $event): void
    {
        $project = $event->getProject();
        $customer = $this->customerService->show($project->customer_id);
//        dd($project , $customer);
    }
}
