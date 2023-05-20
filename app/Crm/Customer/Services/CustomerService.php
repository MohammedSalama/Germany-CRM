<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Models\Customer;
use Crm\Customer\Requests\CreateCustomer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerService
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        return Customer::all();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return Customer::find($id) ?? response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
    }

    /**
     * @param CreateCustomer $request
     * @return Customer
     */
    public function create(string $name)
    {
//        dd($request->all());
        $customer = new Customer();
        $customer->name	= $name;
        $customer->save();

        event(new CustomerCreation($customer));
        return $customer;
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
        return response()->json(['status' => 'Deleted'] , Response::HTTP_OK);
    }
}
