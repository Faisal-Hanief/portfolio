<?php

return [
    'admin' => [
        'name' => env('ADMIN_NAME', 'Admin'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    'profile' => [
        'name' => 'Muhammad Faisal Hanief',
        'headline' => 'Informatics Student',
        'roles' => ['Web Developer', 'Mobile Developer'],
        'tagline' => 'Building practical digital solutions through web and mobile development.',
        'photo' => 'images/profile/profile.jpg',
        'started_year' => 2024,
    ],

    // An empty value makes the matching button show as disabled ("soon").
    'links' => [
        'email' => env('PORTFOLIO_EMAIL') ? 'mailto:'.env('PORTFOLIO_EMAIL') : null,
        'github' => env('PORTFOLIO_GITHUB') ?: null,
        'whatsapp' => env('PORTFOLIO_WHATSAPP') ? 'https://wa.me/'.env('PORTFOLIO_WHATSAPP') : null,
        'linkedin' => env('PORTFOLIO_LINKEDIN') ?: null,
        'cv' => env('PORTFOLIO_CV') ?: null,
    ],

    // Raw contact details used by the seeder.
    'contact' => [
        'email' => env('PORTFOLIO_EMAIL') ?: null,
        'phone' => env('PORTFOLIO_WHATSAPP') ?: null,
    ],
];
