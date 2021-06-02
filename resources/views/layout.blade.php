<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Ingor</title>

    <!-- Styles -->
    @foreach (Ingor::styles() as $asset)
    <link href="{{ asset(mix($asset->path(), $asset->manifestDirectory())) }}" rel="stylesheet">
    @endforeach

    @routes('ingor')
</head>

<body class="bg-purple-100">

    @inertia

    <!-- Scripts -->
    <script src="{{ asset(mix('js/ingor-admin.js', 'vendor/ingor-admin')) }}"></script>

    @foreach (Ingor::scripts() as $asset)
    <script src="{{ asset(mix($asset->path(), $asset->manifestDirectory())) }}"></script>
    @endforeach

    <script src="{{ asset(mix('js/main.js', 'vendor/ingor-admin')) }}"></script>
    <script>
    Ingor.initialApp();
    </script>

</body>
</html>
