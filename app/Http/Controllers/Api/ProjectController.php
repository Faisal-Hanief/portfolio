<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()
            ->with('skills')
            ->orderBy('sort_order')
            ->get();

        return ProjectResource::collection($projects);
    }

    public function show(string $slug)
    {
        $project = Project::published()
            ->with('skills')
            ->where('slug', $slug)
            ->firstOrFail();

        return new ProjectResource($project);
    }
}