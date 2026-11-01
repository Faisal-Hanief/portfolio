<section id="education" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading number="04" label="education" title="Education" />

        <div data-reveal class="glass flex flex-col gap-5 rounded-2xl p-6 sm:flex-row sm:items-start">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-600/20 text-sky-300">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M2 9l10-5 10 5-10 5L2 9z" />
                    <path d="M6 11.5V16c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5v-4.5" />
                    <path d="M22 9v5" />
                </svg>
            </div>

            <div class="flex-1">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Universitas Teknokrat Indonesia</h3>
                        <p class="mt-1 text-sm text-slate-300">Informatics Study Program (S1) · Bandar Lampung</p>
                    </div>

                    <div class="sm:text-right">
                        <p class="text-sm text-cyan-200">{{ $profile['started_year'] }} – Present</p>
                        <span class="mt-1 inline-block rounded-full border border-cyan-400/40 bg-cyan-500/15 px-3 py-0.5 text-xs text-cyan-200">
                            Active student
                        </span>
                    </div>
                </div>

                <p class="mt-5 text-xs text-slate-400">Relevant coursework</p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <span class="skill-chip">Web Programming</span>
                    <span class="skill-chip">Mobile Programming</span>
                </div>
            </div>
        </div>
    </div>
</section>