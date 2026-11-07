<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('skills')->orderBy('id')->get();

        return ProjectResource::collection($projects);
    }

    public function show(string $slug)
    {
        $project = Project::with('skills')->where('slug', $slug)->firstOrFail();

        return new ProjectResource($project);
    }

    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->safe()->except('skill_ids'));

        if ($request->has('skill_ids')) {
            $project->skills()->sync($request->validated('skill_ids'));
        }

        return (new ProjectResource($project->load('skills')))
            ->response()
            ->setStatusCode(201);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->safe()->except('skill_ids'));

        if ($request->has('skill_ids')) {
            $project->skills()->sync($request->validated('skill_ids'));
        }

        return new ProjectResource($project->load('skills'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->noContent();
    }
}