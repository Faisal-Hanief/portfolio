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
                'summary' => 'A Flutter-based beach tourism directory app focused on Lampung Province.',
            ],
            [
                'title' => 'Nusantara Journey',
                'summary' => 'A Flutter village tourism (desa wisata) app for Indonesian users.',
            ],
            [
                'title' => 'GameVault',
                'summary' => 'A Flutter app for managing a personal game collection.',
            ],
        ];

        foreach ($projects as $data) {
            $project = Project::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'summary' => $data['summary'],
                'description' => $data['summary'].' Built with Flutter and Dart.',
                'thumbnail_url' => null,
                'demo_url' => null,
                'github_url' => null,
                'is_featured' => true,
            ]);

            $project->skills()->sync([
                $skills['Flutter']->id,
                $skills['Dart']->id,
            ]);
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
