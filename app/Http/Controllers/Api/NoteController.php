<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Crm\Customer\Services\CustomerService;
use Crm\Note\Models\Note;
use Crm\Note\Requests\CreateNote;
use Crm\Note\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * @var NoteService
     */
    private NoteService $noteService;

    /**
     * @var CustomerService
     */
    private CustomerService $customerService;

    /**
     * @param NoteService $noteService
     * @param CustomerService $customerService
     */
    public function __construct(NoteService $noteService , CustomerService $customerService)
    {
        $this->noteService = $noteService;
        $this->customerService = $customerService;
    }
    /**
     * @param Request $request
     * @param $customerId
     * @return mixed
     */
    public function index(Request $request, $customerId)
    {
        return $this->noteService->index($request , $customerId);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->noteService->show($id);
    }

    /**
     * @param CreateNote $request
     * @param int $customerId
     * @return Note|\Illuminate\Http\JsonResponse
     */
    public function create(CreateNote $request, int $customerId)
    {
//        dd($request->all());
        $customer = $this->customerService->show($customerId);

        if (! $customer) {
            return response()->json(['status' => 'Customer Not Found'] , Response::HTTP_NOT_FOUND);
        }
        return $this->noteService->create($request , $customerId);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id , $customerId)
    {
        return $this->noteService->update($request,$id,$customerId);
    }

    /**
     * @param Request $request
     * @param $customerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $customerId ,$id)
    {
        return $this->noteService->delete($request , $customerId , $id);
    }
}
