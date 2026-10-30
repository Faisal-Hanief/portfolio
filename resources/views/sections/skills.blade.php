<section id="skills" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading number="02" label="skills" title="Technologies I work with" />

        <div id="skills-root">
            {{-- State 1: loading (skeleton) --}}
            <div data-when="loading" class="grid gap-4 md:grid-cols-2" aria-hidden="true">
                @for ($i = 0; $i < 4; $i++)
                    <div class="glass rounded-2xl p-5">
                        <div class="skeleton mb-4 h-6 w-1/2"></div>
                        <div class="flex flex-wrap gap-2">
                            <div class="skeleton h-8 w-20"></div>
                            <div class="skeleton h-8 w-16"></div>
                            <div class="skeleton h-8 w-24"></div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- State 2: error --}}
            <div data-when="error" hidden role="alert"
                 class="glass flex flex-col items-center gap-4 rounded-2xl p-8 text-center sm:flex-row sm:justify-between sm:text-left">
                <p class="text-slate-200">Couldn't load skills. Please check your connection and try again.</p>
                <button id="skills-retry" type="button"
                        class="rounded-lg border border-white/25 px-5 py-2 text-sm font-medium text-white transition hover:border-white/50 hover:bg-white/10">
                    Try again
                </button>
            </div>

            {{-- State 3: ready (filled by JavaScript from /api/skills) --}}
            <div data-when="ready" id="skills-grid" hidden class="grid gap-4 md:grid-cols-2"></div>
        </div>
    </div>
</section>