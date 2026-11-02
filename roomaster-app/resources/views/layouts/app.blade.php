<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Roomaster' }}</title>

    {{-- Plus Jakarta Sans: 400 (Regular), 500 (Medium), 600 (SemiBold), 800 (ExtraBold) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Lucide Script Fallback --}}
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-grey-200 min-h-screen flex items-center justify-center p-0 md:p-6 font-sans antialiased select-none">

    {{-- Mobile Viewport Frame (390px x 844px) --}}
    <main class="w-full max-w-[390px] min-h-[844px] h-[844px] bg-grey-50 shadow-2xl rounded-none md:rounded-[40px] overflow-hidden relative flex flex-col justify-between border border-grey-300">
        @yield('content')
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
