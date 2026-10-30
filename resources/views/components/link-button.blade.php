@props(['href' => null, 'variant' => 'primary', 'icon' => null])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg px-5 py-2.5 text-sm font-medium transition';

    $styles = [
        'primary' => 'btn-gradient',
        'ghost' => 'border border-white/20 text-slate-100 hover:border-white/40 hover:bg-white/5',
    ];

    $icons = [
        'arrow' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'download' => '<path d="M12 4v12m0 0l-5-5m5 5l5-5M5 20h14"/>',
    ];

    $external = $href && str_starts_with($href, 'http');
@endphp

@if ($href)
    <a href="{{ $href }}" @if ($external) target="_blank" rel="noopener noreferrer" @endif
       {{ $attributes->merge(['class' => $base.' '.($styles[$variant] ?? $styles['primary'])]) }}>
        {{ $slot }}
        @if ($icon && isset($icons[$icon]))
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icons[$icon] !!}</svg>
        @endif
    </a>
@else
    <span aria-disabled="true" title="Coming soon"
          {{ $attributes->merge(['class' => $base.' cursor-not-allowed border border-dashed border-white/30 text-slate-400']) }}>
        {{ $slot }}
        <small class="rounded bg-white/10 px-1.5 py-0.5 text-[11px]">soon</small>
    </span>
@endif