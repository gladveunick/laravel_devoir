<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Inclure le CSS de Bootstrap ou votre propre CSS personnalisé -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- Inclure le CSS personnalisé -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Autres balises meta, liens et scripts peuvent être ajoutés ici -->

    <!-- Inclure le script JavaScript de Laravel Mix (pour la compilation des ressources) -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <!-- Contenu de la barre de navigation -->
        </nav>

        <!-- Contenu de la page -->
        <main class="py-4">
            
            @yield('content')
        </main>
    </div>
</body>
</html>
