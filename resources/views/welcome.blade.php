<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Système de Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-4xl mx-auto text-center px-4">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    🎫 Système de Tickets
                </h1>
                <p class="text-xl text-gray-600">
                    Gestion des tickets de support pour administrateurs et clients
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Panel Admin -->
                <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-red-600 text-2xl">👨‍💼</span>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Panel Administrateur</h2>
                    <p class="text-gray-600 mb-6">
                        Gestion complète des tickets, réponses et assignations
                    </p>
                    <a href="/admin/tickets" 
                       class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                        Accéder au panel admin
                    </a>
                </div>

                <!-- Panel Client -->
                <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-blue-600 text-2xl">👤</span>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Panel Client</h2>
                    <p class="text-gray-600 mb-6">
                        Création et suivi de vos tickets de support
                    </p>
                    <a href="/client" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Accéder au panel client
                    </a>
                </div>
            </div>

            <!-- Fonctionnalités -->
            <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Fonctionnalités disponibles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-green-600 text-xl">✅</span>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">Création de tickets</h4>
                        <p class="text-sm text-gray-600">Interface simple pour créer des tickets</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-yellow-600 text-xl">💬</span>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">Système de réponses</h4>
                        <p class="text-sm text-gray-600">Conversation bidirectionnelle</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-purple-600 text-xl">📊</span>
                        </div>
                        <h4 class="font-medium text-gray-900 mb-2">Suivi des statuts</h4>
                        <p class="text-sm text-gray-600">Visualisation en temps réel</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-sm text-gray-500">
                <p>🚀 Panel développé avec Filament PHP et Laravel</p>
            </div>
        </div>
    </div>
</body>
</html>
