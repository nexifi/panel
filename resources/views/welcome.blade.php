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

    <title>Redirection vers le Panel Client</title>

    @filamentStyles

    {{ filament()->getTheme()->getHtml() }}
    {{ filament()->getFontHtml() }}

    <style>
        :root {
            --font-family: '{!! filament()->getFontFamily() !!}';
        }
        .redirect-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 2rem;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="fi-body min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white">
    <div class="redirect-container">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 border border-gray-200 dark:border-gray-700 max-w-md">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-blue-600 dark:text-blue-400 text-2xl">🎫</span>
                </div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                    Redirection en cours...
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Vous allez être redirigé vers le Panel Client
                </p>
                <div class="spinner"></div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                    Si la redirection ne fonctionne pas, 
                    <a href="/client" class="text-blue-600 dark:text-blue-400 hover:underline">
                        cliquez ici
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Redirection automatique après 2 secondes
        setTimeout(function() {
            window.location.href = '/client';
        }, 2000);
    </script>
</body>
</html>
