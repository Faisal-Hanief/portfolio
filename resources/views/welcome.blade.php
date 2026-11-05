
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | Latihan 4a</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-grid" aria-hidden="true"></div>
    <div class="blob blob-a" aria-hidden="true"></div>
    <div class="blob blob-b" aria-hidden="true"></div>

    <main class="relative flex min-h-screen items-center justify-center px-6 text-center">
        <div>
            <p class="font-mono text-sm text-sky-300">// Latihan 4a</p>
            <h1 class="text-gradient mt-3 text-4xl font-semibold sm:text-5xl">
                Laravel is running
            </h1>
            <p class="mt-3 text-slate-300">
                Setup Laravel dan koneksi MySQL berhasil.
            </p>
        </div>
    </main>

    <aside class="glass fixed bottom-5 right-5 max-w-xs rounded-xl p-5 text-sm leading-relaxed text-slate-100">
        <p class="mb-2 font-semibold text-white">🎓 Identitas Pengembang</p>

        <dl class="grid grid-cols-[auto_1fr] gap-x-3 gap-y-1">
            <dt class="text-slate-400">Nama</dt>
            <dd>Muhammad Faisal Hanief</dd>

            <dt class="text-slate-400">NPM</dt>
            <dd>24312201</dd>

            <dt class="text-slate-400">Kelas</dt>
            <dd>IF 24 B</dd>

            <dt class="text-slate-400">PHP</dt>
            <dd>{{ PHP_VERSION }} ✅</dd>

            <dt class="text-slate-400">Laravel</dt>
            <dd>{{ app()->version() }} ✅ Berjalan</dd>

            <dt class="text-slate-400">DB</dt>
            <dd>{{ \Illuminate\Support\Facades\DB::connection()->getDatabaseName() }} ✅ Terhubung</dd>
        </dl>
    </aside>
</body>
</html>
