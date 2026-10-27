<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;

class StatsController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'data' => [
                'projects_count' => Project::published()->count(),
                'skills_count' => Skill::count(),
            ],
        ]);
    }
}