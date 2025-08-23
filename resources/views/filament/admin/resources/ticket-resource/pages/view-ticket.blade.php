<x-filament-panels::page>
    <div class="w-full mx-auto space-y-8">
        <!-- En-tête optimisé et spacieux -->
        <div class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 rounded-3xl p-10 border border-slate-700/50 shadow-2xl">
            <!-- Ligne supérieure avec titre et badges -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-10">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <span class="text-4xl">🎫</span>
                    </div>
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-3 leading-tight">{{ $this->record->subject }}</h1>
                        <p class="text-slate-300 text-xl">Ticket #{{ $this->record->id }}</p>
                    </div>
                </div>
                
                <!-- Badges de statut améliorés -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="px-6 py-4 bg-blue-500/20 text-blue-300 border border-blue-500/30 rounded-xl text-base font-semibold backdrop-blur-sm">
                        {{ match($this->record->status) {
                            'open' => '🔓 Ouvert',
                            'in_progress' => '⚡ En cours',
                            'waiting' => '⏳ En attente',
                            'closed' => '🔒 Fermé',
                        } }}
                    </div>
                    <div class="px-6 py-4 bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 rounded-xl text-base font-semibold backdrop-blur-sm">
                        {{ match($this->record->priority) {
                            'low' => '🟢 Faible',
                            'medium' => '🟡 Moyenne',
                            'high' => '🟠 Haute',
                            'urgent' => '🔴 Urgente',
                        } }}
                    </div>
                </div>
            </div>
            
            <!-- Informations rapides en grille optimisée -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-slate-800/60 backdrop-blur-sm rounded-2xl p-8 border border-slate-700/50 hover:bg-slate-800/80 transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <span class="text-blue-400 text-3xl">📅</span>
                        <div>
                            <p class="text-slate-300 text-sm uppercase font-semibold tracking-wide">Créé le</p>
                            <p class="text-white font-bold text-xl">{{ \Carbon\Carbon::parse($this->record->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/60 backdrop-blur-sm rounded-2xl p-8 border border-slate-700/50 hover:bg-slate-800/80 transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <span class="text-green-400 text-3xl">🔄</span>
                        <div>
                            <p class="text-slate-400 text-sm uppercase font-semibold tracking-wide">Mis à jour</p>
                            <p class="text-white font-bold text-xl">{{ \Carbon\Carbon::parse($this->record->updated_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/60 backdrop-blur-sm rounded-2xl p-8 border border-slate-700/50 hover:bg-slate-800/80 transition-all duration-300">
                    <div class="flex items-center gap-5">
                        <span class="text-purple-400 text-3xl">💬</span>
                        <div>
                            <p class="text-slate-300 text-sm uppercase font-semibold tracking-wide">Réponses</p>
                            <p class="text-white font-bold text-xl">{{ $this->getViewData()['allResponses']->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message initial optimisé -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                    <span class="text-3xl">💭</span>
                    Message initial du ticket
                </h3>
                <p class="text-blue-100 mt-2">Demande originale de l'utilisateur</p>
            </div>
            
            <div class="p-10">
                <div class="flex items-start gap-8 mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                        {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-3">
                            <h4 class="font-bold text-2xl text-gray-900 dark:text-white">{{ $this->getViewData()['initialResponse']->user->username }}</h4>
                            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-xl text-base font-semibold">👤 Client</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">{{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-600">
                    <p class="text-gray-800 dark:text-gray-200 text-xl leading-relaxed whitespace-pre-wrap">{{ $this->getViewData()['initialResponse']->content }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Conversation optimisée -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 px-8 py-6">
                <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                    <span class="text-3xl">💬</span>
                    Conversation
                </h3>
                <p class="text-gray-300 mt-2">Échanges entre client et support</p>
            </div>
            
            <div class="p-10">
                @if($this->getViewData()['followUpResponses']->count() > 0)
                    <div class="space-y-8">
                        @foreach($this->getViewData()['followUpResponses'] as $response)
                        <div class="flex items-start gap-8 p-8 {{ $response->is_staff_response ? 'bg-green-50 dark:bg-green-900/20' : 'bg-blue-50 dark:bg-blue-900/20' }} rounded-2xl border {{ $response->is_staff_response ? 'border-green-200 dark:border-green-800/30' : 'border-blue-200 dark:border-blue-800/30' }} hover:shadow-lg transition-all duration-300">
                            <div class="w-20 h-20 {{ $response->is_staff_response ? 'bg-gradient-to-br from-green-500 to-green-600' : 'bg-gradient-to-br from-blue-500 to-blue-600' }} rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                {{ strtoupper(substr($response->user->username, 0, 2)) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-4 mb-4">
                                    <h4 class="font-bold text-2xl text-gray-900 dark:text-white">{{ $response->user->username }}</h4>
                                    <span class="text-base px-4 py-2 rounded-xl font-semibold {{ $response->is_staff_response ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $response->is_staff_response ? '👨‍💼 Support' : '👤 Client' }}
                                    </span>
                                    <span class="text-base text-gray-500">{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}</span>
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                    <p class="text-gray-700 dark:text-gray-300 text-xl leading-relaxed whitespace-pre-wrap">{{ $response->content }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 text-gray-500">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-4xl">💭</span>
                        </div>
                        <p class="text-xl font-medium">Aucune réponse n'a encore été ajoutée à ce ticket.</p>
                        <p class="text-gray-400 mt-2">Soyez le premier à répondre !</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formulaire optimisé -->
        @if($this->record->isOpen())
        <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                    <span class="text-3xl">✍️</span>
                    Ajouter une réponse
                </h3>
                <p class="text-green-100 mt-2">Continuez la conversation avec notre équipe</p>
            </div>
            
            <div class="p-10">
                <form wire:submit="submit" class="space-y-8">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 border border-gray-200 dark:border-gray-600">
                        {{ $this->form }}
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="group bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-10 py-5 rounded-2xl font-bold text-xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-500/50">
                            <span class="flex items-center gap-3">
                                <span>Envoyer la réponse</span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-filament-panels::page>