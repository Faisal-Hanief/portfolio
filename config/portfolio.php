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
];