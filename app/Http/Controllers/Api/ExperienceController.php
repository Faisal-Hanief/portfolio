<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        return ExperienceResource::collection(
            Experience::orderByDesc('start_date')->get()
        );
    }
}