@extends('layouts.app')

@section('content')
    @include('sections.hero')
    @include('sections.about')
    @include('sections.skills')

    {{-- Temporary placeholder. Replaced in step 4C. --}}
    <section id="projects" class="flex min-h-[60vh] items-center justify-center px-6 text-center">
        <p class="font-mono text-sm text-slate-400">// projects section placeholder</p>
    </section>
@endsection