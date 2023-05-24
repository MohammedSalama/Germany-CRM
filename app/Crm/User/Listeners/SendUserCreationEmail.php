<?php

namespace Crm\User\Listeners;

//use App\Events\UserCreation;
use Crm\User\Events\UserCreation;

class SendUserCreationEmail
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
    public function handle(UserCreation $event): void
    {
        $user = $event->getUser();
    }
}
