<x-filament-panels::page>
    <div class="max-w-6xl mx-auto space-y-8">
        <!-- En-tête du ticket avec design ultra-moderne -->
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-purple-700 to-indigo-800 rounded-3xl shadow-2xl border border-white/10">
            <!-- Effet de brillance -->
            <div class="absolute inset-0 bg-gradient-to-r from-white/5 via-white/10 to-transparent"></div>
            <!-- Motif de points -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
            
            <div class="relative p-10 text-white">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <!-- Titre et informations principales -->
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                                <span class="text-3xl">🎫</span>
                            </div>
                            <div>
                                <p class="text-blue-200 text-lg font-medium">Ticket de support</p>
                                <h1 class="text-4xl lg:text-5xl font-bold leading-tight">{{ $this->getViewData()['ticket']->subject }}</h1>
                            </div>
                        </div>
                        
                        <!-- Métadonnées -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                    <span class="text-xl">📅</span>
                                </div>
                                <div>
                                    <p class="text-blue-200 text-sm font-medium">Créé le</p>
                                    <p class="text-white font-semibold">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->created_at)->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                    <span class="text-xl">🔄</span>
                                </div>
                                <div>
                                    <p class="text-blue-200 text-sm font-medium">Mis à jour</p>
                                    <p class="text-white font-semibold">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->updated_at)->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                    <span class="text-xl">💬</span>
                                </div>
                                <div>
                                    <p class="text-blue-200 text-sm font-medium">Réponses</p>
                                    <p class="text-white font-semibold">{{ $this->getViewData()['allResponses']->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Badges de statut -->
                    <div class="flex flex-col gap-4">
                        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                            <p class="text-blue-200 text-sm font-medium mb-3">Statut du ticket</p>
                            <div class="flex flex-col gap-3">
                                <div class="inline-flex items-center px-4 py-2 {{ match($this->getViewData()['ticket']->status) {
                                    'open' => 'bg-green-500/20 border-green-400/30 text-green-100',
                                    'in_progress' => 'bg-yellow-500/20 border-yellow-400/30 text-yellow-100',
                                    'waiting' => 'bg-blue-500/20 border-blue-400/30 text-blue-100',
                                    'closed' => 'bg-red-500/20 border-red-400/30 text-red-100',
                                } }} rounded-xl border backdrop-blur-sm">
                                    <span class="font-semibold">
                                        {{ match($this->getViewData()['ticket']->status) {
                                            'open' => '🔓 Ouvert',
                                            'in_progress' => '⚡ En cours',
                                            'waiting' => '⏳ En attente',
                                            'closed' => '🔒 Fermé',
                                        } }}
                                    </span>
                                </div>
                                
                                <div class="inline-flex items-center px-4 py-2 {{ match($this->getViewData()['ticket']->priority) {
                                    'low' => 'bg-green-500/20 border-green-400/30 text-green-100',
                                    'medium' => 'bg-yellow-500/20 border-yellow-400/30 text-yellow-100',
                                    'high' => 'bg-orange-500/20 border-orange-400/30 text-orange-100',
                                    'urgent' => 'bg-red-500/20 border-red-400/30 text-red-100',
                                } }} rounded-xl border backdrop-blur-sm">
                                    <span class="font-semibold">
                                        {{ match($this->getViewData()['ticket']->priority) {
                                            'low' => '🟢 Priorité faible',
                                            'medium' => '🟡 Priorité moyenne',
                                            'high' => '🟠 Priorité haute',
                                            'urgent' => '🔴 Priorité urgente',
                                        } }}
                                    </span>
                                </div>
                                
                                @if($this->getViewData()['ticket']->category)
                                <div class="inline-flex items-center px-4 py-2 bg-purple-500/20 border-purple-400/30 text-purple-100 rounded-xl border backdrop-blur-sm">
                                    <span class="font-semibold">
                                        {{ match($this->getViewData()['ticket']->category) {
                                            'general' => '📋 Général',
                                            'technical' => '⚙️ Technique',
                                            'billing' => '💰 Facturation',
                                            'bug' => '🐛 Bug',
                                            'feature' => '✨ Fonctionnalité',
                                            'other' => '📝 Autre',
                                        } }}
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message initial avec design premium -->
        @if($this->getViewData()['initialResponse'])
        <div class="group relative">
            <!-- Ligne de connexion -->
            <div class="absolute left-8 top-0 w-px h-full bg-gradient-to-b from-blue-400 via-purple-400 to-transparent opacity-30"></div>
            
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.02]">
                <!-- En-tête de section -->
                <div class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 px-8 py-6 relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/10 via-transparent to-white/5"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30">
                            <span class="text-2xl">💭</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Message initial du ticket</h3>
                            <p class="text-blue-100">Demande originale de l'utilisateur</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Avatar et informations utilisateur -->
                    <div class="flex items-start gap-6 mb-8">
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                <span class="text-xs">👤</span>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ $this->getViewData()['initialResponse']->user->username }}</h4>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    👤 Client
                                </span>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                    
                    <!-- Contenu du message -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                        <div class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed whitespace-pre-wrap">
                            {{ $this->getViewData()['initialResponse']->content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Conversation avec timeline moderne -->
        <div class="relative">
            <!-- Ligne de connexion principale -->
            <div class="absolute left-8 top-0 w-px h-full bg-gradient-to-b from-gray-300 via-gray-400 to-transparent dark:from-gray-600 dark:via-gray-500"></div>
            
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- En-tête de conversation -->
                <div class="bg-gradient-to-r from-gray-700 via-gray-800 to-gray-900 px-8 py-6 relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/5 via-transparent to-white/10"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30">
                            <span class="text-2xl">💬</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Conversation</h3>
                            <p class="text-gray-300">Échanges entre client et support</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    @if($this->getViewData()['followUpResponses']->count() > 0)
                        <div class="space-y-8">
                            @foreach($this->getViewData()['followUpResponses'] as $index => $response)
                            <div class="relative group">
                                <!-- Connecteur de timeline -->
                                @if(!$loop->last)
                                <div class="absolute left-8 top-20 w-px h-16 bg-gradient-to-b from-gray-300 to-gray-200 dark:from-gray-600 dark:to-gray-700"></div>
                                @endif
                                
                                <div class="flex items-start gap-6">
                                    <!-- Avatar avec indicateur de rôle -->
                                    <div class="relative">
                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg {{ $response->is_staff_response 
                                            ? 'bg-gradient-to-br from-emerald-500 to-teal-600' 
                                            : 'bg-gradient-to-br from-blue-500 to-purple-600' }}">
                                            {{ strtoupper(substr($response->user->username, 0, 2)) }}
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-7 h-7 {{ $response->is_staff_response ? 'bg-emerald-500' : 'bg-blue-500' }} rounded-full border-2 border-white flex items-center justify-center">
                                            <span class="text-xs">{{ $response->is_staff_response ? '👨‍💼' : '👤' }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Contenu du message -->
                                    <div class="flex-1 min-w-0">
                                        <!-- En-tête du message -->
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ $response->user->username }}</h4>
                                                
                                                @if($response->is_staff_response)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">
                                                        👨‍💼 Support
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        👤 Client
                                                    </span>
                                                @endif
                                                
                                                @if($response->is_internal)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                                        🔒 Note interne
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <time class="text-gray-500 dark:text-gray-400 font-medium">
                                                {{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}
                                            </time>
                                        </div>
                                        
                                        <!-- Corps du message -->
                                        <div class="bg-gradient-to-br {{ $response->is_staff_response 
                                            ? 'from-emerald-50 to-teal-50 border-emerald-200 dark:from-emerald-900/20 dark:to-teal-900/20 dark:border-emerald-800' 
                                            : 'from-blue-50 to-purple-50 border-blue-200 dark:from-blue-900/20 dark:to-purple-900/20 dark:border-blue-800' 
                                        }} rounded-2xl p-6 border">
                                            <div class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed whitespace-pre-wrap">
                                                {{ $response->content }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <span class="text-4xl">💭</span>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Conversation vide</h4>
                            <p class="text-gray-500 dark:text-gray-400">Aucune réponse n'a encore été ajoutée à ce ticket.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Formulaire de réponse moderne -->
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- En-tête du formulaire -->
            <div class="bg-gradient-to-r from-emerald-500 via-teal-600 to-emerald-700 px-8 py-6 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-white/10 via-transparent to-white/5"></div>
                <div class="relative flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/30">
                        <span class="text-2xl">✍️</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-white">Ajouter une réponse</h3>
                        <p class="text-emerald-100">Continuez la conversation avec notre équipe</p>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <form wire:submit="submit" class="space-y-6">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
                        {{ $this->form }}
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform transition-all duration-200 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-emerald-500/50">
                            <svg class="w-6 h-6 mr-3 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Envoyer la réponse
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-filament-panels::page>
