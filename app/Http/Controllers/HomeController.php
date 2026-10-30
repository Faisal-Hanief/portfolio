<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __invoke()
    {
        $links = config('portfolio.links');

        // The CV can be a full URL or a path inside the public folder (e.g. docs/cv.pdf).
        if ($links['cv'] && ! Str::startsWith($links['cv'], ['http://', 'https://'])) {
            $links['cv'] = asset($links['cv']);
        }

        return view('home', [
            'profile' => config('portfolio.profile'),
            'links' => $links,
        ]);
    }
}