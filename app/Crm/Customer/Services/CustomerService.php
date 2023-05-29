<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Models\Customer;
use Crm\Customer\Repositories\CustomerRepository;
use Crm\Customer\Requests\CreateCustomer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class CustomerService
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
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        return [
            'statistics' => $this->customerRepository->customerAnalytics(),
            'customer' => $this->customerRepository->all()
        ];
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return [
            'statistics' => $this->customerRepository->customerAnalytics(),
            'customer' => $this->customerRepository->find($id)
        ];
    }

    /**
     * @param CreateCustomer $request
     * @return Customer
     */
    public function create(string $name)
    {
        // dd($request->all());
        return [
            'statistics'  => $this->customerRepository->customerAnalytics(),
            'customer'    => $this->customerRepository->create([
                'name'    => $name
            ])
        ];

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customer->name	= $request->get('name');
        $customer->save();
        event(new CustomerCreation($customer));

        return $customer;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, int $id)
    {
        $customer = Customer::find($id);

        if (!$customer)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customer->delete();

        event(new CustomerCreation($customer));

        return response()->json(['status' => 'Deleted'] , Response::HTTP_OK);
    }
}
