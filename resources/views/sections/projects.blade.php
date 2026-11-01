<section id="projects" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading number="03" label="projects" title="Things I've built" />

        <div id="projects-root">
            {{-- State 1: loading (skeleton) --}}
            <div data-when="loading" class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3" aria-hidden="true">
                @for ($i = 0; $i < 3; $i++)
                    <div class="glass overflow-hidden rounded-2xl">
                        <div class="skeleton h-40 w-full !rounded-none"></div>
                        <div class="space-y-3 p-5">
                            <div class="skeleton h-5 w-2/3"></div>
                            <div class="skeleton h-4 w-full"></div>
                            <div class="skeleton h-4 w-5/6"></div>
                            <div class="flex gap-2 pt-2">
                                <div class="skeleton h-7 w-16"></div>
                                <div class="skeleton h-7 w-14"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- State 2: error --}}
            <div data-when="error" hidden role="alert"
                 class="glass flex flex-col items-center gap-4 rounded-2xl p-8 text-center sm:flex-row sm:justify-between sm:text-left">
                <p class="text-slate-200">Couldn't load projects. Please check your connection and try again.</p>
                <button id="projects-retry" type="button"
                        class="rounded-lg border border-white/25 px-5 py-2 text-sm font-medium text-white transition hover:border-white/50 hover:bg-white/10">
                    Try again
                </button>
            </div>

            {{-- State 3: ready (filled by JavaScript from /api/projects) --}}
            <div data-when="ready" id="projects-grid" hidden class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3"></div>
        </div>
    </div>
</section>