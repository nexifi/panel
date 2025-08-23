<x-filament-panels::page>
    <div class="max-w-full mx-auto space-y-6 px-4">
        <!-- En-tête moderne et épuré -->
        <div class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 rounded-2xl p-8 border border-slate-700/50">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-2xl">🎫</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-1">{{ $this->getViewData()['ticket']->subject }}</h1>
                        <p class="text-slate-300">Ticket #{{ $this->getViewData()['ticket']->id }}</p>
                    </div>
                </div>
                
                <!-- Badges de statut -->
                <div class="flex gap-3">
                    <span class="px-4 py-2 bg-blue-500/20 text-blue-300 border border-blue-500/30 rounded-lg text-sm font-medium">
                        {{ match($this->getViewData()['ticket']->status) {
                            'open' => '🔓 Ouvert',
                            'in_progress' => '⚡ En cours',
                            'waiting' => '⏳ En attente',
                            'closed' => '🔒 Fermé',
                        } }}
                    </span>
                    <span class="px-4 py-2 bg-yellow-500/20 text-yellow-300 border border-yellow-500/30 rounded-lg text-sm font-medium">
                        {{ match($this->getViewData()['ticket']->priority) {
                            'low' => '🟢 Faible',
                            'medium' => '🟡 Moyenne',
                            'high' => '🟠 Haute',
                            'urgent' => '🔴 Urgente',
                        } }}
                    </span>
                </div>
            </div>
            
            <!-- Informations rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-800/50 rounded-lg p-6 border border-slate-700/50">
                    <div class="flex items-center gap-4">
                        <span class="text-blue-400 text-2xl">📅</span>
                        <div>
                            <p class="text-slate-400 text-sm uppercase font-medium">Créé le</p>
                            <p class="text-white font-semibold text-lg">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 rounded-lg p-6 border border-slate-700/50">
                    <div class="flex items-center gap-4">
                        <span class="text-green-400 text-2xl">🔄</span>
                        <div>
                            <p class="text-slate-400 text-sm uppercase font-medium">Mis à jour</p>
                            <p class="text-white font-semibold text-lg">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->updated_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 rounded-lg p-6 border border-slate-700/50">
                    <div class="flex items-center gap-4">
                        <span class="text-purple-400 text-2xl">💬</span>
                        <div>
                            <p class="text-slate-400 text-sm uppercase font-medium">Réponses</p>
                            <p class="text-white font-semibold text-lg">{{ $this->getViewData()['allResponses']->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message initial simplifié -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="bg-blue-600 px-6 py-4 rounded-t-xl">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <span>💭</span>
                    Message initial du ticket
                </h3>
            </div>
            
            <div class="p-8">
                <div class="flex items-center gap-6 mb-6">
                    <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                        {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-bold text-xl text-gray-900 dark:text-white">{{ $this->getViewData()['initialResponse']->user->username }}</p>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-lg text-sm font-medium">👤 Client</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                    <p class="text-gray-800 dark:text-gray-200 text-lg leading-relaxed">{{ $this->getViewData()['initialResponse']->content }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Conversation simplifiée -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="bg-gray-700 px-6 py-4 rounded-t-xl">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <span>💬</span>
                    Conversation
                </h3>
            </div>
            
            <div class="p-8">
                @if($this->getViewData()['followUpResponses']->count() > 0)
                    <div class="space-y-6">
                        @foreach($this->getViewData()['followUpResponses'] as $response)
                        <div class="flex items-start gap-6 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl">
                            <div class="w-14 h-14 {{ $response->is_staff_response ? 'bg-green-500' : 'bg-blue-500' }} rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($response->user->username, 0, 2)) }}
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $response->user->username }}</span>
                                    <span class="text-sm px-3 py-1 rounded-lg font-medium {{ $response->is_staff_response ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $response->is_staff_response ? '👨‍💼 Support' : '👤 Client' }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}</span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">{{ $response->content }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 text-gray-500">
                        <p class="text-lg">Aucune réponse n'a encore été ajoutée à ce ticket.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formulaire simplifié -->
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="bg-green-600 px-6 py-4 rounded-t-xl">
                <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                    <span>✍️</span>
                    Ajouter une réponse
                </h3>
            </div>
            
            <div class="p-8">
                <form wire:submit="submit" class="space-y-6">
                    {{ $this->form }}
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-colors shadow-lg hover:shadow-xl">
                            Envoyer la réponse
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-filament-panels::page>
