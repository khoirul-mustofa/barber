<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sedang Maintenance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO --}}
    <meta name="robots" content="noindex,nofollow">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #020617);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-slate-200">

    <div class="max-w-lg w-full text-center px-6">
        <div class="bg-slate-900/70 backdrop-blur rounded-2xl shadow-xl p-8 border border-slate-800">

            {{-- Icon --}}
            <div class="mx-auto mb-6 flex items-center justify-center h-16 w-16 rounded-full bg-yellow-500/10 text-yellow-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v3m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                </svg>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl font-bold tracking-tight mb-2">
                Sedang Maintenance
            </h1>

            {{-- Subtitle --}}
            <p class="text-slate-400 mb-6">
                Kami sedang melakukan pembaruan sistem agar layanan lebih stabil dan cepat.
                Silakan kembali beberapa saat lagi 🙏
            </p>

            {{-- Divider --}}
            <div class="border-t border-slate-800 my-6"></div>

            {{-- Info --}}
            <div class="text-sm text-slate-500 space-y-1">
                <p>⏱ Estimasi: Beberapa menit</p>
            </div>

        </div>

        {{-- Footer --}}
        <p class="mt-6 text-xs text-slate-600">
            &copy; 2026 KUGA Barbershop. Design by PALCUMPING.GL
        </p>
    </div>

</body>
</html>
