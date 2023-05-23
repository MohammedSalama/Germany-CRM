<?php

namespace Crm\Invoice\Services;

use Crm\Invoice\Models\Invoice;
use Crm\Invoice\Requests\CreateInvoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceService
{

    /**
     * @param Request $request
     * @param $customerId
     * @return mixed
     */
    public function index(Request $request, $customerId)
    {
        return Invoice::where('customer_id', $customerId)->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
//        dd($id);
        return Invoice::find($id) ?? response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Request $request
     * @param int $customerId
     * @return Invoice
     */
    public function create(CreateInvoice $request , int $customerId)
    {
        $invoice = new Invoice();
        $invoice->total	= $request->get('total');
        $invoice->items	= $request->get('items');
        $invoice->status = $request->get('status');

        $invoice->customer_id	= $customerId;

        $invoice->save();

        event(new InvoiceService($invoice));

        return $invoice;
    }

    /**
     * @param Request $request
     * @param $id
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id , $customerId)
    {
        $invoice = Invoice::find($id);

        if (!$invoice)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customerId = (int) $customerId;

        if ($invoice->customer_id !== $customerId)
        {
            return response()->json(['status' => 'Invalid Data'] , Response::HTTP_BAD_REQUEST);
        }

        $invoice->total	= $request->get('total');
        $invoice->items	= $request->get('items');
        $invoice->status = $request->get('status');

        $invoice->save();
        return $invoice;
    }

    /**
     * @param Request $request
     * @param $customerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $customerId ,$id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customerId = (int) $customerId;

        if ($invoice->customer_id !== $customerId)
        {
            return response()->json(['status' => 'Invalid Data'] , Response::HTTP_BAD_REQUEST);
        }

        $invoice->delete();
        return response()->json(['status' => 'Deleted'] , Response::HTTP_OK);
    }
}
