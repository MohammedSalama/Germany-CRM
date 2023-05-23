<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Crm\Customer\Services\CustomerService;
use Crm\Invoice\Models\Invoice;
use Crm\Invoice\Requests\CreateInvoice;
use Crm\Invoice\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    /**
     * @var InvoiceService
     */
    private InvoiceService $invoiceService;

    /**
     * @var CustomerService
     */
    private CustomerService $customerService;

    /**
     * @param InvoiceService $invoiceService
     * @param CustomerService $customerService
     */
    public function __construct(InvoiceService $invoiceService,CustomerService $customerService )
    {
        $this->invoiceService = $invoiceService;
        $this->customerService = $customerService;
    }

    /**
     * @param Request $request
     * @param $customerId
     * @return mixed
     */
    public function index(Request $request, $customerId)
    {
        return $this->invoiceService->index($request , $customerId);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
//        dd($id);
        return $this->invoiceService->show($id);
    }

    /**
     * @param CreateInvoice $request
     * @param int $customerId
     * @return Invoice|\Illuminate\Http\JsonResponse
     */
    public function create(CreateInvoice $request , int $customerId)
    {
        $customer = $this->customerService->show($customerId);

        if (! $customer) {
            return response()->json(['status' => 'Customer Not Found'] , Response::HTTP_NOT_FOUND);
        }
        return $this->invoiceService->create($request , $customerId);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id , $customerId)
    {
        return $this->invoiceService->update($request,$id,$customerId);
    }

    /**
     * @param Request $request
     * @param $customerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $customerId ,$id)
    {
        return $this->invoiceService->delete($request , $customerId , $id);
    }
}
