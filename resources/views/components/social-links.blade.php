
@props(['links', 'size' => 'md'])

@php
    $items = [
        [
            'label' => 'GitHub',
            'href' => $links['github'] ?? null,
            'icon' => '<circle cx="6" cy="6" r="2"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="9" r="2"/><path d="M6 8v8"/><path d="M18 11c0 3-4 3-8 4"/>',
        ],
        [
            'label' => 'Email',
            'href' => $links['email'] ?? null,
            'icon' => '<rect x="3" y="5" width="18" height="14" rx="2.5"/><path d="M3.5 7l8.5 6 8.5-6"/>',
        ],
        [
            'label' => 'WhatsApp',
            'href' => $links['whatsapp'] ?? null,
            'icon' => '<path d="M4 20l1.3-4A8.5 8.5 0 1 1 8 18.7L4 20z"/>',
        ],
        [
            'label' => 'LinkedIn',
            'href' => $links['linkedin'] ?? null,
            'icon' => '<rect x="3" y="7" width="18" height="13" rx="2.5"/><path d="M9 7V5.5A1.5 1.5 0 0 1 10.5 4h3A1.5 1.5 0 0 1 15 5.5V7M3 13h18"/>',
        ],
    ];

    $box = $size === 'sm' ? 'h-8 w-8' : 'h-9 w-9';
@endphp

<ul class="flex items-center gap-2" aria-label="Social links">
    @foreach ($items as $item)
        @php
            $svg = '<svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.$item['icon'].'</svg>';
        @endphp

        <li>
            @if (filled($item['href']))
                <a href="{{ $item['href'] }}"
                   @if (str_starts_with($item['href'], 'http'))
                       target="_blank"
                       rel="noopener noreferrer"
                   @endif
                   class="social-btn {{ $box }}"
                   aria-label="{{ $item['label'] }}"
                   title="{{ $item['label'] }}">
                    {!! $svg !!}
                </a>
            @else
                <span class="social-btn social-btn-off {{ $box }}"
                      role="img"
                      aria-disabled="true"
                      aria-label="{{ $item['label'] }} (coming soon)"
                      title="{{ $item['label'] }} (coming soon)">
                    {!! $svg !!}
                </span>
            @endif
        </li>
    @endforeach
</ul>
