<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{ config('app.favicon') }}" />

    <title>Panel - Système de Tickets</title>

    @filamentStyles

    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}

    <style>
        :root {
            --font-family: '{!! filament()->getFontFamily() !!}';
        }
    </style>

    @if (! filament()->hasDarkMode())
        <script>
            localStorage.setItem('theme', 'light');
        </script>
    @elseif (filament()->hasDarkModeForced())
        <script>
            localStorage.setItem('theme', 'dark');
        </script>
    @else
        <script>
            const theme = localStorage.getItem('theme') ??
            @js(filament()->getDefaultThemeMode()->value)

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                        .matches)
            ) {
                document.documentElement.classList.add('dark');
            }
        </script>
    @endif
</head>

<body class="fi-body min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white">
    <!-- Header avec navigation -->
    <header class="bg-white dark:bg-gray-900 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                            🎫 Panel - Système de Tickets
                        </h1>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 px-3 py-2 text-sm font-medium border-b-2 border-blue-500">
                        Accueil
                    </a>
                    <a href="/admin/tickets" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Panel Admin
                    </a>
                    <a href="/client" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Panel Client
                    </a>
                </nav>
                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path class="dark:hidden" fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            <path class="hidden dark:block" fill-rule="evenodd" d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="space-y-6">
            <!-- Titre principal -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    🎫 Système de Tickets
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Gestion des tickets de support pour administrateurs et clients
                </p>
            </div>

            <!-- Cartes des panels -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Panel Admin -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-red-600 dark:text-red-400 text-2xl">👨‍💼</span>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Panel Administrateur</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            Gestion complète des tickets, réponses et assignations
                        </p>
                        <a href="/admin/tickets" 
                           class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                            Accéder au panel admin
                        </a>
                    </div>
                </div>

                <!-- Panel Client -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-blue-600 dark:text-blue-400 text-2xl">👤</span>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Panel Client</h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            Création et suivi de vos tickets de support
                        </p>
                        <a href="/client" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Accéder au panel client
                        </a>
                    </div>
                </div>
            </div>

            <!-- Fonctionnalités -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6 text-center">Fonctionnalités disponibles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-green-600 dark:text-green-400 text-xl">✅</span>
                        </div>
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Création de tickets</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Interface simple pour créer des tickets
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-yellow-600 dark:text-yellow-400 text-xl">💬</span>
                        </div>
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Système de réponses</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Conversation bidirectionnelle
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-purple-600 dark:text-purple-400 text-xl">📊</span>
                        </div>
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Suivi des statuts</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Visualisation en temps réel
                        </p>
                    </div>
                </div>
            </div>

            <!-- Guide rapide -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100 mb-4">🚀 Guide rapide</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800 dark:text-blue-200">
                    <div>
                        <strong>Pour les administrateurs :</strong> Accédez au panel admin pour gérer tous les tickets, assigner des agents et répondre aux demandes.
                    </div>
                    <div>
                        <strong>Pour les clients :</strong> Utilisez le panel client pour créer des tickets, suivre leur évolution et communiquer avec le support.
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="flex flex-col items-center justify-center text-center space-y-2 p-4 text-gray-600 dark:text-gray-400 mt-12">
        <a class="font-semibold" href="https://pelican.dev/docs/#core-team" target="_blank">
            &copy; {{ date('Y') }} Pelican
        </a>
        @if(config('app.debug'))
            <div class="flex space-x-1 text-xs">
                <x-filament::icon
                    :icon="'tabler-clock'"
                    @class(['w-4 h-4 text-gray-500 dark:text-gray-400'])
                />
                <span>{{ round(microtime(true) - LARAVEL_START, 3) }}s</span>
            </div>
        @endif
    </footer>

    <script>
        // Toggle du thème
        document.getElementById('theme-toggle').addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>
