<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class HomeController extends Controller
{
    public function __invoke()
    {
        $model = Profile::first();

        // Hero settings (roles, tagline) come from config; name, photo, bio, and location come from the database.
        $profile = config('portfolio.profile');

        if ($model) {
            $profile['name'] = $model->full_name;
            $profile['photo'] = $model->photo_url ?: $profile['photo'];
            $profile['location'] = $model->location;
            $profile['bio'] = preg_split('/\R{2,}/', trim($model->bio));
        }

        return view('home', [
            'profile' => $profile,
            'links' => $this->links($model),
        ]);
    }

    // Contact links are built from the profiles table. A missing value shows a disabled "soon" button.
    private function links(?Profile $profile): array
    {
        $phone = preg_replace('/\D/', '', (string) $profile?->phone);

        return [
            'email' => $profile?->email ? 'mailto:'.$profile->email : null,
            'github' => $profile?->github_url ?: null,
            'whatsapp' => $phone ? 'https://wa.me/'.$phone : null,
            'linkedin' => $profile?->linkedin_url ?: null,
            'instagram' => $profile?->instagram_url ?: null,
            'cv' => $profile?->cv_url ? asset($profile->cv_url) : null,
        ];
    }
}