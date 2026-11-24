<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedProfile();
        $skills = $this->seedSkills();
        $this->seedProjects($skills);
        $this->seedExperiences();
        $this->seedCertificates();
    }

    private function seedProfile(): void
    {
        $phone = config('portfolio.contact.phone');

        Profile::create([
            'full_name' => 'Muhammad Faisal Hanief',
            'headline' => 'Informatics Student | Web & Mobile Developer',
            'bio' => implode("\n\n", [
                "Hi, I'm Faisal, an Informatics student at Universitas Teknokrat Indonesia in Bandar Lampung. I started in 2024, and I've been learning web and mobile development through coursework and the projects I build along the way.",
                'On the web, I work with Laravel, Tailwind CSS, and MySQL. On mobile, I build apps with Flutter and Dart. I like the design side too, so I plan screens in Figma before I start coding.',
                "I'm still learning, and I enjoy turning what I learn into something that works. I'm looking for internship and career opportunities where I can keep improving and contribute where I can.",
            ]),
            'photo_url' => 'images/profile/profile.jpg',
            'cv_url' => config('portfolio.links.cv'),
            'email' => config('portfolio.contact.email') ?? 'your-email@example.com',
            'phone' => $phone ? '+'.$phone : null,
            'location' => 'Bandar Lampung, Indonesia',
            'github_url' => config('portfolio.links.github'),
            'linkedin_url' => config('portfolio.links.linkedin'),
            'instagram_url' => null,
        ]);
    }

    /** @return array<string, Skill> */
    private function seedSkills(): array
    {
        $skills = [];

        $data = [
            ['HTML', 'Frontend', 'html5'],
            ['CSS', 'Frontend', 'css3'],
            ['JavaScript', 'Frontend', 'javascript'],
            ['Tailwind CSS', 'Frontend', 'tailwindcss'],
            ['Flutter', 'Frontend', 'flutter'],
            ['Dart', 'Frontend', 'dart'],
            ['PHP', 'Backend', 'php'],
            ['Laravel', 'Backend', 'laravel'],
            ['REST API', 'Backend', 'rest-api'],
            ['MySQL', 'Database', 'mysql'],
            ['Firebase', 'Database', 'firebase'],
            ['Figma', 'Tools', 'figma'],
            ['Git', 'Tools', 'git'],
            ['GitHub', 'Tools', 'github'],
            ['Visual Studio Code', 'Tools', 'vscode'],
        ];

        foreach ($data as [$name, $category, $icon]) {
            $skills[$name] = Skill::create([
                'name' => $name,
                'category' => $category,
                'icon' => $icon,
            ]);
        }

        return $skills;
    }

/** @param array<string, Skill> $skills */
private function seedProjects(array $skills): void
{
    $projects = [
        [
            'title' => 'CleanTrip',
            'summary' => 'A mobile directory for discovering hidden beaches in Lampung, Indonesia.',
            'description' => 'CleanTrip is a Flutter-based tourism directory featuring beach destinations in Lampung. Users can explore destinations, search and filter beaches, save favorites, and access travel guides.',
            'thumbnail_url' => 'images/projects/cleantrip.webp',
            'skills' => ['Flutter', 'Dart'],
        ],
        [
            'title' => 'Nusantara Journey',
            'summary' => 'A mobile tourism marketplace and trip planner for Indonesian tourist villages.',
            'description' => 'Nusantara Journey helps travelers discover tourist villages, explore destinations, book travel packages, and manage travel plans. Developed with Flutter and Firebase.',
            'thumbnail_url' => 'images/projects/nusantara-journey.webp',
            'skills' => ['Flutter', 'Dart', 'Firebase'],
        ],
        [
            'title' => 'GameVault',
            'summary' => 'A personal game collection tracker with playtime monitoring and statistics.',
            'description' => 'GameVault allows users to organize game collections, manage wishlists, track playtime, assign ratings, monitor gaming progress, and view collection statistics.',
            'thumbnail_url' => 'images/projects/gamevault.webp',
            'skills' => ['Flutter', 'Dart'],
        ],
        [
            'title' => 'Teknoji',
            'summary' => 'A marketplace for buying and selling second-hand PC components and accessories.',
            'description' => 'Teknoji is a mobile marketplace built with Flutter and Firebase. Users can browse and list second-hand PC components, save favorites, negotiate through real-time chat, and receive message notifications.',
            'thumbnail_url' => 'images/projects/teknoji.webp',
            'skills' => ['Flutter', 'Dart', 'Firebase'],
        ],
    ];

    foreach ($projects as $data) {
        $project = Project::updateOrCreate(
            ['slug' => Str::slug($data['title'])],
            [
                'title' => $data['title'],
                'summary' => $data['summary'],
                'description' => $data['description'],
                'thumbnail_url' => $data['thumbnail_url'],
                'is_featured' => true,
            ]
        );

        $skillIds = [];

        foreach ($data['skills'] as $skillName) {
            $skillIds[] = $skills[$skillName]->id;
        }

        $project->skills()->sync($skillIds);
    }
}


    private function seedExperiences(): void
    {
        Experience::create([
            'title' => 'Informatics Student',
            'organization' => 'Universitas Teknokrat Indonesia',
            'type' => 'Pendidikan',
            'start_date' => '2024-09-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Informatics Study Program (S1). Coursework includes web programming and mobile programming.',
        ]);

        Experience::create([
            'title' => 'Sales & Operations Staff',
            'organization' => 'Mega Buwana',
            'type' => 'Kerja',
            'start_date' => '2019-01-01',
            'end_date' => '2024-12-31',
            'is_current' => false,
            'description' => 'Handled sales, customer service, stock management, goods receiving, order preparation, delivery, and transactions.',
        ]);

        Experience::create([
            'title' => 'Member, Cleanliness and Environment Division',
            'organization' => 'OSIS (Student Council)',
            'type' => 'Organisasi',
            'start_date' => '2017-01-01',
            'end_date' => '2018-12-31',
            'is_current' => false,
            'description' => 'Supervised school cleanliness, organized class cleaning activities, encouraged students to keep the environment clean, and arranged cleaning duty and community service schedules.',
        ]);
    }

    private function seedCertificates(): void
    {
        $certificates = [
            [
                'title' => 'Guide to Learn SQL with AI at DQLab',
                'date' => '2025-10-11',
            ],
            [
                'title' => 'Fundamental SQL Using SELECT Statement',
                'date' => '2025-10-12',
            ],
            [
                'title' => 'Mengolah Data Teks Unstructured dengan REGEX pada SQL',
                'date' => '2025-10-17',
            ],
            [
                'title' => 'SQL Database Management',
                'date' => '2025-10-19',
            ],
        ];

        foreach ($certificates as $data) {
            Certificate::create([
                'title' => $data['title'],
                'issuer' => 'DQLab',
                'issued_date' => $data['date'],
                'credential_url' => null,
                'description' => null,
            ]);
        }
    }
}
