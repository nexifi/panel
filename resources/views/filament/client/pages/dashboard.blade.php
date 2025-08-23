<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Bienvenue -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 text-white">
            <div class="text-center">
                <h1 class="text-3xl font-bold mb-2">
                    Bienvenue sur votre espace client
                </h1>
                <p class="text-xl opacity-90">
                    Gérez vos tickets de support et vos serveurs en toute simplicité
                </p>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-plus-circle class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Créer un ticket
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Signalez un problème ou posez une question
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('filament.client.resources.tickets.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Nouveau ticket
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-ticket class="w-6 h-6 text-green-600 dark:text-green-400" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Mes tickets
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Consultez l'état de vos demandes
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('filament.client.resources.tickets.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Voir mes tickets
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-server class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Mes serveurs
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Gérez vos serveurs et accédez aux consoles
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('filament.client.resources.servers.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Voir mes serveurs
                    </a>
                </div>
            </div>
        </div>

        <!-- Informations utiles -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                Comment ça marche ?
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 dark:text-blue-400 font-bold text-lg">1</span>
                    </div>
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Créez votre ticket</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Décrivez votre problème avec des détails
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-yellow-600 dark:text-yellow-400 font-bold text-lg">2</span>
                    </div>
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Suivez l'évolution</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Consultez les réponses de notre équipe
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-purple-600 dark:text-purple-400 font-bold text-lg">3</span>
                    </div>
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Gérez vos serveurs</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Accédez aux consoles et fichiers
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-green-600 dark:text-green-400 font-bold text-lg">4</span>
                    </div>
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Résolution</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Votre problème est résolu !
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
