
<section id="certificates" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading
            number="05"
            label="certificates"
            title="Certificates & Achievements"
        />

        <div id="certificates-root">

            {{-- Loading --}}
            <div
                data-when="loading"
                class="grid gap-5 sm:grid-cols-2 lg:grid-cols-2"
                aria-hidden="true"
            >
                @for ($i = 0; $i < 3; $i++)
                    <div class="glass flex items-center gap-4 rounded-2xl p-4">
                        <div class="skeleton h-11 w-11 shrink-0 rounded-xl"></div>
                        <div class="flex-1">
                            <div class="skeleton mb-3 h-4 w-3/4"></div>
                            <div class="skeleton h-3 w-1/2"></div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- Error --}}
            <div
                data-when="error"
                hidden
                role="alert"
                class="glass flex flex-col items-center gap-4 rounded-2xl p-8 text-center"
            >
                <p class="text-slate-200">
                    Couldn't load certificates. Please try again.
                </p>

                <button
                    id="certificates-retry"
                    type="button"
                    class="rounded-lg border border-white/25 px-5 py-2 text-sm text-white transition hover:bg-white/10"
                >
                    Try again
                </button>
            </div>

            {{-- Ready --}}
            <div
                data-when="ready"
                id="certificates-grid"
                hidden
                class="grid gap-5 sm:grid-cols-2 lg:grid-cols-2"
            ></div>

        </div>
    </div>
</section>
