<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    style="max-width:100%; overflow-x:hidden;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased" style="max-width:100%; overflow-x:hidden;">
    @inertia
</body>

</html>
