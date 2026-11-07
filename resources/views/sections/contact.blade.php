@php
    $contactLinks = [
        [
            'label' => 'Email',
            'hint' => 'Send me an email',
            'href' => $links['email'],
            'icon' => '<rect x="3" y="5" width="18" height="14" rx="2.5"/><path d="M3.5 7l8.5 6 8.5-6"/>',
        ],
        [
            'label' => 'GitHub',
            'hint' => 'See my code',
            'href' => $links['github'],
            'icon' => '<circle cx="6" cy="6" r="2"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="9" r="2"/><path d="M6 8v8"/><path d="M18 11c0 3-4 3-8 4"/>',
        ],
        [
            'label' => 'WhatsApp',
            'hint' => 'Chat with me',
            'href' => $links['whatsapp'],
            'icon' => '<path d="M4 20l1.3-4A8.5 8.5 0 1 1 8 18.7L4 20z"/>',
        ],
        [
            'label' => 'LinkedIn',
            'hint' => 'Connect with me',
            'href' => $links['linkedin'],
            'icon' => '<rect x="3" y="7" width="18" height="13" rx="2.5"/><path d="M9 7V5.5A1.5 1.5 0 0 1 10.5 4h3A1.5 1.5 0 0 1 15 5.5V7M3 13h18"/>',
        ],
    ];
@endphp

<section id="contact" class="relative px-6 py-24">
    <div class="mx-auto max-w-6xl">
        <x-section-heading number="06" label="contact" title="Let's get in touch" />

        <div class="grid items-start gap-10 lg:grid-cols-2">
            {{-- Left: intro and contact links --}}
            <div>
                <p data-reveal class="mb-6 leading-relaxed text-slate-300">
                    Have a question, an opportunity, or just want to say hi? Send me a message through the form
                    or reach out on any of these.
                </p>

                <div data-reveal style="--reveal-delay: 100ms" class="grid gap-3">
                    @foreach ($contactLinks as $item)
                        @php
                            $hasLink = filled($item['href']);
                            $external = $hasLink && str_starts_with($item['href'], 'http');
                            $iconSvg = '<svg class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.$item['icon'].'</svg>';
                        @endphp

                        @if ($hasLink)
                            <a href="{{ $item['href'] }}" @if ($external) target="_blank" rel="noopener noreferrer" @endif class="contact-link">
                                <span class="contact-icon">{!! $iconSvg !!}</span>
                                <span>
                                    <span class="block text-sm font-medium text-white">{{ $item['label'] }}</span>
                                    <span class="block text-xs text-slate-400">{{ $item['hint'] }}</span>
                                </span>
                            </a>
                        @else
                            <div class="contact-link contact-link-off" aria-disabled="true" title="Coming soon">
                                <span class="contact-icon">{!! $iconSvg !!}</span>
                                <span class="flex-1">
                                    <span class="block text-sm font-medium">{{ $item['label'] }}</span>
                                    <span class="block text-xs">Coming soon</span>
                                </span>
                                <small class="rounded bg-white/10 px-1.5 py-0.5 text-[11px]">soon</small>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Right: message form (sent to POST /api/contact by contact.js) --}}
            <form id="contact-form" data-reveal style="--reveal-delay: 150ms" class="glass rounded-2xl p-6">
                <div class="space-y-4">
                    <div>
                        <label for="contact-name" class="form-label">Name</label>
                        <input id="contact-name" name="name" type="text" maxlength="100" autocomplete="name" required
                               placeholder="Your name" class="form-field">
                        <p class="form-error" data-error-for="name" hidden></p>
                    </div>

                    <div>
                        <label for="contact-email" class="form-label">Email</label>
                        <input id="contact-email" name="email" type="email" maxlength="150" autocomplete="email" required
                               placeholder="you@example.com" class="form-field">
                        <p class="form-error" data-error-for="email" hidden></p>
                    </div>

                    <div>
                        <label for="contact-subject" class="form-label">Subject</label>
                        <input id="contact-subject" name="subject" type="text" maxlength="150" required
                               placeholder="What is this about?" class="form-field">
                        <p class="form-error" data-error-for="subject" hidden></p>
                    </div>

                    <div>
                        <label for="contact-message" class="form-label">Message</label>
                        <textarea id="contact-message" name="message" rows="5" minlength="10" maxlength="2000" required
                                  placeholder="Write your message here..." class="form-field"></textarea>
                        <p class="form-error" data-error-for="message" hidden></p>
                    </div>
                </div>

                <button id="contact-submit" type="submit"
                        class="btn-gradient mt-5 inline-flex w-full items-center justify-center rounded-lg px-5 py-3 text-sm font-medium disabled:cursor-not-allowed disabled:opacity-60">
                    Send message
                </button>

                <p id="contact-status" class="form-status" role="status" aria-live="polite" hidden></p>
            </form>
        </div>
    </div>
</section>