<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Mobile Development' => ['Flutter', 'Dart'],
            'Web Development' => ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'Tailwind CSS'],
            'Database & Backend' => ['MySQL', 'Firebase', 'REST API'],
            'Design & Tools' => ['Figma', 'Git', 'GitHub', 'Visual Studio Code'],
        ];

        $categoryOrder = 1;

        foreach ($data as $categoryName => $skills) {
            $category = SkillCategory::updateOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName, 'sort_order' => $categoryOrder++]
            );

            foreach ($skills as $index => $skillName) {
                $category->skills()->updateOrCreate(
                    ['name' => $skillName],
                    ['sort_order' => $index + 1]
                );
            }
        }
    }
}