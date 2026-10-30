@extends('layouts.app')

@section('content')
    <section id="home" class="relative flex min-h-screen items-center justify-center px-6 pt-24 text-center">
        <div>
            <p class="font-mono text-sm text-sky-300">// base layout ready</p>
            <h1 class="text-gradient mt-3 text-4xl font-semibold sm:text-5xl">{{ $profile['name'] }}</h1>
            <p class="mt-3 text-slate-300">{{ $profile['tagline'] }}</p>
        </div>
    </section>

    {{-- Temporary placeholder so the navbar scroll effect can be tested. Replaced in step 4B. --}}
    <section id="about" class="flex min-h-screen items-center justify-center px-6 text-center">
        <p class="font-mono text-sm text-slate-400">// about section placeholder</p>
    </section>
@endsection