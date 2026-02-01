<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'A Secret Valentine for You' }}</title>
    <meta name="description" content="A vintage, secret love proposal waiting to be opened.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Dearest, you have a secret message... ✉️">
    <meta property="og:description"
        content="Someone has sent you a vintage Valentine's proposal. Enter the secret word to unlock it.">
    <meta property="og:image" content="{{ asset('images/og-valentine.jpg') }}">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="A Secret Valentine for You">
    <meta property="twitter:description" content="A vintage love letter is waiting for you. Will you open it?">
    <meta property="twitter:image" content="{{ asset('images/og-valentine.jpg') }}">

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>❤️</text></svg>">

    <link
        href="https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased bg-black overflow-hidden font-serif">
    {{ $slot }}

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>

</html>
