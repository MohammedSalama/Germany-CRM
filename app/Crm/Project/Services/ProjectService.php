<?php

namespace Crm\Project\Services;

use Crm\Project\Events\ProjectCreation;
use Crm\Project\Models\Project;
use Crm\Project\Requests\CreateProject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectService
{
    /**
     * @param Request $request
     * @param $customerId
     * @return mixed
     */
    public function index(Request $request, $customerId)
    {
        return Project::where('customer_id',$customerId)->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return Project::find($id) ?? response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
    }

    /**
     * @param CreateProject $request
     * @param int $customerId
     * @return Project
     */
    public function create(CreateProject $request , int $customerId)
    {
        $project = new Project();
        $project->project_name = $request->project_name;
        $project->status = (bool)$request->status;
        $project->customer_id = $customerId;
        $project->project_cost = (float)$request->project_cost;
        $project->save();

        event(new ProjectCreation($project));
        return $project;
    }

    /**
     * @param Request $request
     * @param $id
     * @param int $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id , $customerId)
    {
//        dd($request);
        $project = Project::find($id);

        if (!$project)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

        $customerId = (int) $customerId;

        if ($project->customer_id !== $customerId)
        {
            return response()->json(['status' => 'Invalid Data'] , Response::HTTP_BAD_REQUEST);
        }
        $project->project_name = $request->get('project_name');
        $project->status = $request->get('status');
        $project->customer_id = $request->get('customer_id');
        $project->project_cost = $request->get('project_cost');

        $project->save();

        event(new ProjectCreation($project));

        return $project;
    }

    /**
     * @param Request $request
     * @param $customerId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $customerId ,$id)
    {
        $project = Project::find($id);

        if (!$project)
        {
            return response()->json(['status' => 'Not Found'] , Response::HTTP_NOT_FOUND);
        }

//        $customerId = (int) $customerId;

        if ($project->customer_id !== $customerId)
        {
            return response()->json(['status' => 'Invalid Data'] , Response::HTTP_BAD_REQUEST);
        }

        $project->delete();

        event(new ProjectCreation($project));

        return response()->json(['status' => 'Deleted'] , Response::HTTP_OK);
    }
}
