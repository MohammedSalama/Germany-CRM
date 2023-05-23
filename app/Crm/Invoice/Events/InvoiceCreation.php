<?php

declare(strict_types=1);

namespace Crm\Invoice\Events;

use Crm\Invoice\Models\Invoice;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceCreation
{
    use Dispatchable;
    use SerializesModels;
    use InteractsWithSockets;

    /**
     * @var Invoice
     */
    private Invoice $invoice;

    /**
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->setInvoice($invoice);
    }

    /**
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    /**
     * @param Invoice $invoice
     */
    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    /**
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
