<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Crm\Customer\Services\CustomerService;
use Crm\Project\Models\Project;
use Crm\Project\Requests\CreateProject;
use Crm\Project\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * @var ProjectService
     */
    private ProjectService $projectService;

    private CustomerService $customerService;
    /**
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService , CustomerService $customerService)
    {
        $this->projectService = $projectService;
        $this->customerService = $customerService;
    }

    /**
     * @param Request $request
     * @param $customerId
     * @return mixed
     */
    public function index(Request $request, $customerId)
    {
//        dd($request);
        return $this->projectService->index($request , $customerId);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->projectService->show($id);
    }

    /**
     * @param CreateProject $request
     * @param $customerId
     * @return Project
     */
    public function create(CreateProject $request , $customerId)
    {
        $customer = $this->customerService->show($customerId);

        if (! $customer) {
            return response()->json(['status' => 'Customer Not Found'] , Response::HTTP_NOT_FOUND);
        }
        return $this->projectService->create($request , $customerId);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id , $customerId)
    {
//        dd($request);
        return $this->projectService->update($request , $id , $customerId);
    }

    /**
     * @param Request $request
     * @param $customerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $customerId ,$id)
    {
        return $this->projectService->delete($request , $customerId , $id);
    }
}
