<x-filament-panels::page>
    <div class="w-full space-y-6">
        
        <!-- En-tête du serveur -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Sauvegardes du serveur {{ $this->getViewData()['server']->name }}
                    </h1>
                    <p class="text-gray-600 mt-1">Gérez et restaurez les sauvegardes de votre serveur</p>
                </div>
                <div class="flex gap-2">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        💾 Créer une sauvegarde
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        📤 Uploader une sauvegarde
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistiques des sauvegardes -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
                <div class="flex items-center gap-3">
                    <span class="text-3xl">💾</span>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">{{ count($this->getViewData()['backups']) }}</div>
                        <div class="text-sm text-gray-600">Total sauvegardes</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
                <div class="flex items-center gap-3">
                    <span class="text-3xl">📅</span>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">2h</div>
                        <div class="text-sm text-gray-600">Dernière sauvegarde</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
                <div class="flex items-center gap-3">
                    <span class="text-3xl">💿</span>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">8.2 GB</div>
                        <div class="text-sm text-gray-600">Espace utilisé</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
                <div class="flex items-center gap-3">
                    <span class="text-3xl">✅</span>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">100%</div>
                        <div class="text-sm text-gray-600">Taux de réussite</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des sauvegardes -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900">Historique des sauvegardes</h3>
                <div class="flex gap-2">
                    <button class="text-blue-600 hover:text-blue-700 px-3 py-1 rounded text-sm font-medium">
                        🔄 Actualiser
                    </button>
                </div>
            </div>
            
            <div class="space-y-3">
                @foreach($this->getViewData()['backups'] as $backup)
                <div class="flex items-center justify-between p-4 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg hover:bg-gray-100/80 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 flex items-center justify-center">
                            @if($backup['type'] === 'automatic')
                                <span class="text-blue-600 text-2xl">🤖</span>
                            @else
                                <span class="text-green-600 text-2xl">👤</span>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-900">{{ $backup['name'] }}</span>
                                @if($backup['type'] === 'automatic')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Automatique</span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Manuelle</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-4 text-sm text-gray-500 mt-1">
                                <span>📏 {{ $backup['size'] }}</span>
                                <span>📅 {{ \Carbon\Carbon::parse($backup['created_at'])->format('d/m/Y H:i') }}</span>
                                <span class="text-green-600">✅ {{ ucfirst($backup['status']) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="text-blue-600 hover:text-blue-700 px-3 py-1 rounded text-sm font-medium">
                            📥 Télécharger
                        </button>
                        <button class="text-green-600 hover:text-green-700 px-3 py-1 rounded text-sm font-medium">
                            🔄 Restaurer
                        </button>
                        <button class="text-red-600 hover:text-red-700 px-3 py-1 rounded text-sm font-medium">
                            🗑️ Supprimer
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Configuration des sauvegardes -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Configuration des sauvegardes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                        <div>
                            <div class="font-medium text-gray-900">Sauvegardes automatiques</div>
                            <div class="text-sm text-gray-600">Toutes les 24h à 12:00</div>
                        </div>
                        <div class="w-12 h-6 bg-blue-600 rounded-full relative">
                            <div class="w-5 h-5 bg-white rounded-full absolute right-0.5 top-0.5"></div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                        <div>
                            <div class="font-medium text-gray-900">Compression</div>
                            <div class="text-sm text-gray-600">GZIP (niveau 6)</div>
                        </div>
                        <div class="w-12 h-6 bg-gray-300 rounded-full relative">
                            <div class="w-5 h-5 bg-white rounded-full absolute left-0.5 top-0.5"></div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                        <div>
                            <div class="font-medium text-gray-900">Rétention</div>
                            <div class="text-sm text-gray-600">30 jours maximum</div>
                        </div>
                        <div class="text-blue-600 font-medium">Modifier</div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                        <div>
                            <div class="font-medium text-gray-900">Notifications</div>
                            <div class="text-sm text-gray-600">Email + Discord</div>
                        </div>
                        <div class="text-blue-600 font-medium">Configurer</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-filament-panels::page>
