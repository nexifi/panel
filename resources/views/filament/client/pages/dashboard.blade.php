<x-filament-panels::page>
    <div class="space-y-6">
        <!-- En-tête avec actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Bienvenue sur votre espace client</h2>
                    <p class="text-gray-600 mt-1">Gérez vos serveurs et créez des tickets de support</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('filament.client.resources.tickets.create') }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                        <span>➕</span>
                        <span>Nouveau Ticket</span>
                    </a>
                    <a href="{{ route('filament.client.resources.tickets.index') }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors flex items-center space-x-2">
                        <span>🎫</span>
                        <span>Mes Tickets</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Widgets de résumé des tickets -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{ $this->widgets['header'] }}
        </div>

        <!-- Section des serveurs -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">🎮 Mes Serveurs</h3>
                    <a href="{{ route('filament.client.resources.servers.create') }}" 
                       class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors">
                        ➕ Nouveau serveur
                    </a>
                </div>
            </div>
            <div class="p-6">
                {{ $this->widgets['footer'] }}
            </div>
        </div>

        <!-- Guide d'utilisation -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-medium text-blue-900 mb-4">💡 Comment utiliser votre espace client</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-bold text-lg">🎮</span>
                    </div>
                    <h4 class="font-medium text-blue-900 mb-2">Gérez vos serveurs</h4>
                    <p class="text-sm text-blue-700">
                        Consultez l'état de vos serveurs, accédez à la console et gérez vos fichiers
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-bold text-lg">🎫</span>
                    </div>
                    <h4 class="font-medium text-blue-900 mb-2">Créez des tickets</h4>
                    <p class="text-sm text-blue-700">
                        Demandez de l'aide ou signalez des problèmes via notre système de support
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-bold text-lg">📊</span>
                    </div>
                    <h4 class="font-medium text-blue-900 mb-2">Suivez l'évolution</h4>
                    <p class="text-sm text-blue-700">
                        Consultez l'historique de vos tickets et les réponses de notre équipe
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
