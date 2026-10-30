@extends('layouts.app')

@section('content')
    <main class="relative flex min-h-screen items-center justify-center px-6 text-center">
        <div>
            <p class="font-mono text-sm text-sky-300">// base layout ready</p>
            <h1 class="text-gradient mt-3 text-4xl font-semibold sm:text-5xl">{{ $profile['name'] }}</h1>
            <p class="mt-3 text-slate-300">{{ $profile['tagline'] }}</p>
            <div class="glass mx-auto mt-8 max-w-xs rounded-xl px-5 py-4 text-sm text-slate-200">
                Gradient background, grid, and blobs are working.
            </div>
        </div>
    </main>
@endsection