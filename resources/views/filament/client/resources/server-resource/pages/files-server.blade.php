<x-filament-panels::page>
    <div class="w-full space-y-6">
        
        <!-- En-tête du serveur -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Fichiers du serveur {{ $this->getViewData()['server']->name }}
                    </h1>
                    <p class="text-gray-600 mt-1">Gérez les fichiers de votre serveur</p>
                </div>
                <div class="flex gap-2">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        📁 Nouveau dossier
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        📄 Nouveau fichier
                    </button>
                </div>
            </div>
        </div>

        <!-- Navigation des dossiers -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                <span class="font-medium">Chemin actuel:</span>
                <span class="text-blue-600">/</span>
            </div>
            
            <!-- Liste des fichiers -->
            <div class="space-y-2">
                @foreach($this->getViewData()['files'] as $file)
                <div class="flex items-center justify-between p-4 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg hover:bg-gray-100/80 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 flex items-center justify-center">
                            @if($file['type'] === 'directory')
                                <span class="text-blue-600 text-xl">📁</span>
                            @else
                                <span class="text-gray-600 text-xl">📄</span>
                            @endif
                        </div>
                        <div>
                            <span class="font-medium text-gray-900">{{ $file['name'] }}</span>
                            <div class="flex items-center gap-4 text-sm text-gray-500 mt-1">
                                <span>{{ $file['size'] }}</span>
                                <span>Modifié le {{ \Carbon\Carbon::parse($file['modified'])->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        @if($file['type'] === 'directory')
                            <button class="text-blue-600 hover:text-blue-700 px-3 py-1 rounded text-sm font-medium">
                                Ouvrir
                            </button>
                        @else
                            <button class="text-green-600 hover:text-green-700 px-3 py-1 rounded text-sm font-medium">
                                Éditer
                            </button>
                        @endif
                        <button class="text-red-600 hover:text-red-700 px-3 py-1 rounded text-sm font-medium">
                            Supprimer
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Actions rapides</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button class="p-4 bg-blue-50/80 backdrop-blur-sm border border-blue-200/50 rounded-lg hover:bg-blue-100/80 transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📥</span>
                        <div>
                            <div class="font-medium text-blue-900">Télécharger</div>
                            <div class="text-sm text-blue-600">Télécharger des fichiers</div>
                        </div>
                    </div>
                </button>
                
                <button class="p-4 bg-green-50/80 backdrop-blur-sm border border-green-200/50 rounded-lg hover:bg-green-100/80 transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📤</span>
                        <div>
                            <div class="font-medium text-green-900">Uploader</div>
                            <div class="text-sm text-green-600">Envoyer des fichiers</div>
                        </div>
                    </div>
                </button>
                
                <button class="p-4 bg-purple-50/80 backdrop-blur-sm border border-purple-200/50 rounded-lg hover:bg-purple-100/80 transition-colors text-left">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">🔍</span>
                        <div>
                            <div class="font-medium text-purple-900">Rechercher</div>
                            <div class="text-sm text-purple-600">Trouver des fichiers</div>
                        </div>
                    </div>
                </button>
            </div>
        </div>

    </div>
</x-filament-panels::page>
