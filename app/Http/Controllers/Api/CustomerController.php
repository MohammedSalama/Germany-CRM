<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Crm\Customer\Models\Customer;
use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        return $this->customerService->index($request);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->customerService->show($id);
    }

    /**
     * @param CreateCustomer $request
     * @return Customer
     */
    public function create(CreateCustomer $request)
    {
//        dd($request->all());
        return $this->customerService->create($request);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
       return $this->customerService->update($request,$id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $id)
    {
       return $this->customerService->delete($request, (int) $id);
    }
}
