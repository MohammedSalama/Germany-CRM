<?php

declare(strict_types=1);

namespace Crm\Customer\Events;

use Crm\Customer\Events\Illuminate;
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
     * @return void
     */
    public function __construct(
        //
    ) {}

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): Illuminate\Broadcasting\Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
