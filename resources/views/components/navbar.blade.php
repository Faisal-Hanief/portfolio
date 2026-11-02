@php
    $items = [
        'home' => 'Home',
        'about' => 'About',
        'skills' => 'Skills',
        'projects' => 'Projects',
        'education' => 'Education',
    ];
@endphp

<header id="navbar" class="fixed inset-x-0 top-0 z-40">
    <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4" aria-label="Main navigation">
        <a href="#home" class="text-gradient text-xl font-semibold">FH.</a>

        <div class="hidden items-center gap-7 md:flex">
            @foreach ($items as $id => $label)
                <a href="#{{ $id }}" data-nav-link class="nav-link">{{ $label }}</a>
            @endforeach
            <a href="#contact" data-nav-link class="btn-outline-gradient"><span>Contact me</span></a>
        </div>

        <button id="menu-toggle" type="button" class="rounded-lg p-2 text-slate-200 md:hidden"
                aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle menu">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16" />
            </svg>
        </button>
    </nav>

    <div id="mobile-menu" class="mx-4 hidden rounded-xl border border-white/10 bg-[#0A1030]/95 p-4 backdrop-blur md:hidden">
        <div class="flex flex-col gap-3">
            @foreach ($items as $id => $label)
                <a href="#{{ $id }}" class="rounded-lg px-2 py-1.5 text-slate-200 hover:bg-white/5">{{ $label }}</a>
            @endforeach
            <a href="#contact" class="btn-outline-gradient mt-1 w-full"><span class="w-full text-center">Contact me</span></a>
        </div>
    </div>
</header>