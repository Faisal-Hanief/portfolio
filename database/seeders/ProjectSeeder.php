<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'CleanTrip',
                'slug' => 'cleantrip',
                'description' => 'A Flutter-based beach tourism directory app focused on Lampung Province.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Nusantara Journey',
                'slug' => 'nusantara-journey',
                'description' => 'A Flutter village tourism (desa wisata) app for Indonesian users.',
                'sort_order' => 2,
            ],
            [
                'title' => 'GameVault',
                'slug' => 'gamevault',
                'description' => 'A Flutter app for managing a personal game collection.',
                'sort_order' => 3,
            ],
        ];

        $skillIds = Skill::whereIn('name', ['Flutter', 'Dart'])->pluck('id');

        foreach ($projects as $data) {
            $project = Project::updateOrCreate(['slug' => $data['slug']], $data);
            $project->skills()->sync($skillIds);
        }
    }
}