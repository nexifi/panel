<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démonstration - Panel Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">🎫 Panel Client - Démonstration</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Connecté en tant que : <strong>client@test.com</strong></span>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md text-sm hover:bg-red-700">
                            Déconnexion
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-8">
                    <a href="#" class="border-b-2 border-blue-500 text-blue-600 px-3 py-4 text-sm font-medium">
                        🏠 Accueil
                    </a>
                    <a href="#" class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-3 py-4 text-sm font-medium">
                        🎫 Mes Tickets
                    </a>
                    <a href="#" class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-3 py-4 text-sm font-medium">
                        ➕ Nouveau Ticket
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Widgets de résumé -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-md flex items-center justify-center">
                                    <span class="text-blue-600 text-lg">🎫</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total des tickets</dt>
                                    <dd class="text-lg font-medium text-gray-900">3</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-md flex items-center justify-center">
                                    <span class="text-yellow-600 text-lg">⏳</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Tickets ouverts</dt>
                                    <dd class="text-lg font-medium text-gray-900">2</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center">
                                    <span class="text-green-600 text-lg">✅</span>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Tickets fermés</dt>
                                    <dd class="text-lg font-medium text-gray-900">1</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white shadow rounded-lg p-6 mb-8">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Actions rapides</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center space-x-2">
                        <span>➕</span>
                        <span>Créer un nouveau ticket</span>
                    </button>
                    <button class="w-full bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors flex items-center justify-center space-x-2">
                        <span>👁️</span>
                        <span>Voir tous mes tickets</span>
                    </button>
                </div>
            </div>

            <!-- Liste des tickets récents -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Mes tickets récents</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Ticket 1 -->
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-900">Problème de connexion à l'API</h3>
                                <p class="text-sm text-gray-500 mt-1">Créé le 23/08/2025 à 10:30</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    En cours
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Moyenne
                                </span>
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Voir →
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 2 -->
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-900">Demande de fonctionnalité</h3>
                                <p class="text-sm text-gray-500 mt-1">Créé le 22/08/2025 à 15:45</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ouvert
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Haute
                                </span>
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Voir →
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Ticket 3 -->
                    <div class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-900">Question sur la facturation</h3>
                                <p class="text-sm text-gray-500 mt-1">Créé le 20/08/2025 à 09:15</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Fermé
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Moyenne
                                </span>
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Voir →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guide d'utilisation -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-8">
                <h3 class="text-lg font-medium text-blue-900 mb-4">💡 Comment utiliser le panel client</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold text-lg">1</span>
                        </div>
                        <h4 class="font-medium text-blue-900 mb-2">Créez votre ticket</h4>
                        <p class="text-sm text-blue-700">
                            Cliquez sur "Créer un nouveau ticket" et décrivez votre problème
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold text-lg">2</span>
                        </div>
                        <h4 class="font-medium text-blue-900 mb-2">Suivez l'évolution</h4>
                        <p class="text-sm text-blue-700">
                            Consultez les réponses de notre équipe en temps réel
                        </p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-blue-600 font-bold text-lg">3</span>
                        </div>
                        <h4 class="font-medium text-blue-900 mb-2">Répondez si besoin</h4>
                        <p class="text-sm text-blue-700">
                            Ajoutez des informations ou posez des questions
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
