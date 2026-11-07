@php
    $paragraphs = $profile['bio'] ?? [];

    $facts = [
        ['label' => 'Based in', 'value' => $profile['location'] ?? 'Bandar Lampung, Indonesia'],
        ['label' => 'Studying', 'value' => 'Informatics, Universitas Teknokrat Indonesia'],
        ['label' => 'Focus', 'value' => 'Web & mobile development'],
        ['label' => 'Open to', 'value' => 'Internships & career opportunities'],
    ];
@endphp

<section id="about" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading number="01" label="about" title="A little about me" />

        <div class="grid items-start gap-10 lg:grid-cols-[1.3fr_1fr]">
            <div class="space-y-4 text-base leading-relaxed text-slate-300">
                @foreach ($paragraphs as $paragraph)
                    <p data-reveal style="--reveal-delay: {{ $loop->index * 100 }}ms">{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                @foreach ($facts as $fact)
                    <div data-reveal style="--reveal-delay: {{ 100 + $loop->index * 80 }}ms" class="glass rounded-xl p-4">
                        <p class="text-xs text-slate-400">{{ $fact['label'] }}</p>
                        <p class="mt-1 text-sm font-medium text-white">{{ $fact['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>