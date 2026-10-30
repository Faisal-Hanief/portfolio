@php
    $facts = [
        ['label' => 'Based in', 'value' => 'Bandar Lampung, Indonesia'],
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
                <p data-reveal>
                    Hi, I'm Faisal, an Informatics student at Universitas Teknokrat Indonesia in Bandar Lampung.
                    I started in 2024, and I've been learning web and mobile development through coursework and
                    the projects I build along the way.
                </p>
                <p data-reveal style="--reveal-delay: 100ms">
                    On the web, I work with Laravel, Tailwind CSS, and MySQL. On mobile, I build apps with Flutter
                    and Dart. I like the design side too, so I plan screens in Figma before I start coding.
                </p>
                <p data-reveal style="--reveal-delay: 200ms">
                    I'm still learning, and I enjoy turning what I learn into something that works. I'm looking for
                    internship and career opportunities where I can keep improving and contribute where I can.
                </p>
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