<section id="experience" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading number="05" label="experience" title="Experience & Organization" />

        <div id="experience-root">
            {{-- Loading --}}
            <div data-when="loading" class="space-y-4" aria-hidden="true">
                @for ($i = 0; $i < 2; $i++)
                    <div class="glass rounded-2xl p-6">
                        <div class="skeleton mb-3 h-6 w-1/2"></div>
                        <div class="skeleton mb-3 h-4 w-1/3"></div>
                        <div class="skeleton h-16 w-full"></div>
                    </div>
                @endfor
            </div>

            {{-- Error --}}
            <div data-when="error" hidden role="alert"
                 class="glass flex flex-col items-center gap-4 rounded-2xl p-8 text-center">
                <p class="text-slate-200">Couldn't load experience. Please try again.</p>
                <button id="experience-retry" type="button"
                        class="rounded-lg border border-white/25 px-5 py-2 text-sm text-white transition hover:bg-white/10">
                    Try again
                </button>
            </div>

            {{-- Ready --}}
            <div data-when="ready" id="experience-list" hidden class="space-y-4"></div>
        </div>
    </div>
</section>