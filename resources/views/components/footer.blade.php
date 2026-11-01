@props(['profile'])

<footer class="relative border-t border-white/10 px-6 py-8">
    <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 text-sm text-slate-400 md:flex-row">
        <div class="flex items-center gap-4">
            <a href="#home" class="text-gradient text-lg font-semibold">FH.</a>
            <span>© {{ date('Y') }} {{ $profile['name'] }}</span>
        </div>

        <p>Built with Laravel, Tailwind CSS, and MySQL</p>

        <a href="#home" class="transition hover:text-white">Back to top ↑</a>
    </div>
</footer>