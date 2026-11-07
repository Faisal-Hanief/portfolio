<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;

class SkillController extends Controller
{
    // Display order of the category enum
    private const CATEGORIES = ['Frontend', 'Backend', 'Database', 'Tools'];

    public function index()
    {
        $grouped = Skill::orderBy('id')->get()->groupBy('category');

        $data = collect(self::CATEGORIES)
            ->filter(fn ($category) => $grouped->has($category))
            ->map(fn ($category) => [
                'category' => $category,
                'skills' => SkillResource::collection($grouped[$category])->resolve(),
            ])
            ->values();

        return response()->json(['data' => $data]);
    }
}