<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-ink font-sans text-gray-100 antialiased">
    <main class="px-6 text-center">
        <p class="font-mono text-sm text-brand-blue">// setup check</p>
        <h1 class="mt-3 bg-linear-to-r from-brand-blue via-brand-violet to-brand-cyan bg-clip-text text-4xl font-semibold text-transparent">
            Laravel 12 + Tailwind v4 is working
        </h1>
        <p class="mt-3 text-gray-400">If this heading shows a blue, violet, and cyan gradient, the setup is ready.</p>
    </main>
</body>
</html>