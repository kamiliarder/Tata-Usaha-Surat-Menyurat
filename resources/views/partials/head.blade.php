<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<!-- Fonts - Multiple sources for better compatibility -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Primary fonts from Bunny (privacy-friendly) -->
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Fallback fonts from Google Fonts for better Linux support -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
