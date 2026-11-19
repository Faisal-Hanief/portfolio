
@props(['profile', 'links'])

<footer class="relative border-t border-white/10 px-6 py-10">
    <div class="mx-auto max-w-6xl space-y-8">

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Identity --}}
            <div>
                <a href="#home" class="text-gradient text-xl font-semibold">
                    FH.
                </a>

                <p class="mt-3 max-w-xs text-sm leading-relaxed text-slate-400">
                    {{ $profile['headline'] }}
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-sm font-semibold text-white">
                    Quick Links
                </h3>

                <ul class="mt-4 grid grid-cols-2 gap-3 text-sm text-slate-400">
                    <li><a href="#home" class="transition hover:text-white">Home</a></li>
                    <li><a href="#about" class="transition hover:text-white">About</a></li>
                    <li><a href="#skills" class="transition hover:text-white">Skills</a></li>
                    <li><a href="#projects" class="transition hover:text-white">Projects</a></li>
                    <li><a href="#experience" class="transition hover:text-white">Experience</a></li>
                    <li><a href="#certificates" class="transition hover:text-white">Certificates</a></li>
                    <li><a href="#contact" class="transition hover:text-white">Contact</a></li>
                </ul>
            </div>

            {{-- Social Links --}}
            <div>
                <h3 class="text-sm font-semibold text-white">
                    Connect with me
                </h3>

                <div class="mt-4">
                    <x-social-links :links="$links" size="sm" />
                </div>
            </div>

        </div>

        <div class="flex flex-col items-center justify-between gap-3 border-t border-white/10 pt-6 text-sm text-slate-500 sm:flex-row">
            <p>
                © {{ date('Y') }} {{ $profile['name'] }}. All rights reserved.
            </p>

            <p>Built with Laravel, Tailwind CSS, and MySQL</p>

            <a href="#home" class="transition hover:text-white">
                Back to top ↑
            </a>
        </div>

    </div>
</footer>
