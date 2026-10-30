<section id="home" class="relative flex min-h-screen items-center px-6 pb-20 pt-28">
    <div class="mx-auto w-full max-w-6xl">
        <div class="grid items-center gap-12 md:grid-cols-[1.2fr_1fr]">

            <div class="order-2 text-center md:order-1 md:text-left">
                <p data-reveal class="font-mono text-sm text-sky-300">// hello, I'm</p>

                <h1 data-reveal style="--reveal-delay: 80ms"
                    class="text-gradient mt-3 text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">
                    {{ $profile['name'] }}
                </h1>

                <p data-reveal style="--reveal-delay: 160ms" class="mt-4 text-lg text-slate-200 sm:text-xl">
                    {{ $profile['headline'] }} |
                    <span id="typed-role" class="text-violet-300"
                          data-roles="{{ json_encode($profile['roles']) }}">{{ $profile['roles'][0] }}</span><span class="typing-cursor" aria-hidden="true"></span>
                </p>

                <p data-reveal style="--reveal-delay: 240ms" class="mx-auto mt-4 max-w-xl text-slate-300 md:mx-0">
                    {{ $profile['tagline'] }}
                </p>

                <div data-reveal style="--reveal-delay: 320ms"
                     class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center md:justify-start">
                    <x-link-button href="#projects" variant="primary" icon="arrow">View projects</x-link-button>
                    <x-link-button :href="$links['cv']" variant="ghost" icon="download">Download CV</x-link-button>
                </div>
            </div>

            <div class="order-1 flex justify-center md:order-2">
                <div data-reveal style="--reveal-delay: 200ms" class="relative h-64 w-64 sm:h-72 sm:w-72 lg:h-80 lg:w-80">
                    <div class="photo-ring absolute inset-0"></div>
                    <img src="{{ asset($profile['photo']) }}" alt="Portrait of {{ $profile['name'] }}"
                         width="320" height="320" class="photo-img" fetchpriority="high">

                    <span class="tech-chip" style="top: 6%; left: -6%;">Flutter</span>
                    <span class="tech-chip" style="top: 46%; right: -12%; animation-delay: -1.6s;">Laravel</span>
                    <span class="tech-chip" style="bottom: 4%; left: 2%; animation-delay: -3.2s;">Tailwind</span>
                </div>
            </div>
        </div>

        <div data-reveal style="--reveal-delay: 400ms" class="mt-14 grid grid-cols-3 gap-3 sm:gap-4">
            <div class="glass rounded-xl px-4 py-3 text-center md:text-left">
                <p class="text-2xl font-semibold text-white"><span data-stat="projects_count">–</span></p>
                <p class="text-xs text-slate-300">Projects</p>
            </div>
            <div class="glass rounded-xl px-4 py-3 text-center md:text-left">
                <p class="text-2xl font-semibold text-white"><span data-stat="skills_count">–</span></p>
                <p class="text-xs text-slate-300">Technologies</p>
            </div>
            <div class="glass rounded-xl px-4 py-3 text-center md:text-left">
                <p class="text-2xl font-semibold text-white">{{ $profile['started_year'] }}</p>
                <p class="text-xs text-slate-300">Started studying</p>
            </div>
        </div>
    </div>

    <a href="#about" class="absolute bottom-5 left-1/2 hidden -translate-x-1/2 font-mono text-xs text-slate-400 transition hover:text-white md:block">scroll ↓</a>
</section>