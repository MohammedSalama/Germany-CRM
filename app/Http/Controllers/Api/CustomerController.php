<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Crm\Customer\Models\Customer;
use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Services\CustomerExportService;
use Crm\Customer\Services\CustomerService;
use Crm\Customer\Services\Export\ExportFactory;
use Crm\Customer\Services\Export\ExportInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    private CustomerService $customerService;

    /**
     * @var CustomerExportService
     */
    private CustomerExportService $customerExportService;

    /**
     * @param CustomerService $customerService
     * @param CustomerExportService $customerExportService
     */
    public function __construct(CustomerService $customerService, CustomerExportService $customerExportService)
    {
        $this->customerService = $customerService;
        $this->customerExportService = $customerExportService;
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
        return $this->customerService->show($id) ?? response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
    }

    /**
     * @param CreateCustomer $request
     * @return Customer
     */
    public function create(CreateCustomer $request)
    {
//        dd($request->all());
        return $this->customerService->create($request->name);
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

    /**
     * @param Request $request
     * @return void
     * @throws \Crm\Customer\Exceptions\InvalidExportFormat
     */
    public function export(Request $request)
    {
//        dd($request->get('format','json'));
        $format = $request->get('format','json');
        $exporter = ExportFactory::instance($format);
        return $this->customerExportService->export($exporter);
    }
}
