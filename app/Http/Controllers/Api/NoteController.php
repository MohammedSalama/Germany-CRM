<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * @param Request $request
     * @param $customerId
     * @return mixed
     */
    public function index(Request $request, $customerId)
    {
        return Note::where('customer_id',$customerId)->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return Note::find($id) ?? response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
    }

    /**
     * @param Request $request
     * @param $customerId
     * @return Note
     */
    public function create(Request $request,$customerId)
    {
//        dd($request->all());
        $note = new Note();
        $note->note	= $request->get('note');
        $note->customer_id	= $customerId;

        $note->save();
        return $note;

    }

    /**
     * @param Request $request
     * @param $id
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id , $customerId)
    {
        $note = Note::find($id);

        if (!$note)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customerId = (int) $customerId;

        if ($note->customer_id !== $customerId)
        {
            return response()->json(['status' => 'Invalid Data'] , Response::HTTP_BAD_REQUEST);
        }

        $note->note	= $request->get('note');
        $note->save();
        return $note;
    }

    /**
     * @param Request $request
     * @param $customerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $customerId ,$id)
    {
        $note = Note::find($id);

        if (!$note)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customerId = (int) $customerId;

        if ($note->customer_id !== $customerId)
        {
            return response()->json(['status' => 'Invalid Data'] , Response::HTTP_BAD_REQUEST);
        }

        $note->delete();
        return response()->json(['status' => 'Deleted'] , Response::HTTP_OK);
    }
}
