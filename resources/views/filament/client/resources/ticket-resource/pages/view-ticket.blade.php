<x-filament-panels::page>
    <div class="max-w-7xl mx-auto space-y-12">
        <!-- En-tête du ticket avec design moderne -->
        <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-3xl shadow-2xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative p-12 text-white">
                <div class="flex items-center justify-between mb-12">
                    <div>
                        <h1 class="text-5xl font-bold mb-4">{{ $this->getViewData()['ticket']->subject }}</h1>
                        <p class="text-blue-100 text-2xl">Ticket #{{ $this->getViewData()['ticket']->id }}</p>
                    </div>
                    <div class="flex flex-col items-end space-y-6">
                        <div class="flex space-x-6">
                            <div class="px-8 py-4 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                                <span class="text-lg font-medium">
                                    {{ match($this->getViewData()['ticket']->status) {
                                        'open' => '🔓 Ouvert',
                                        'in_progress' => '⚡ En cours',
                                        'waiting' => '⏳ En attente',
                                        'closed' => '🔒 Fermé',
                                    } }}
                                </span>
                            </div>
                            <div class="px-8 py-4 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                                <span class="text-lg font-medium">
                                    {{ match($this->getViewData()['ticket']->priority) {
                                        'low' => '🟢 Faible',
                                        'medium' => '🟡 Moyenne',
                                        'high' => '🟠 Haute',
                                        'urgent' => '🔴 Urgente',
                                    } }}
                                </span>
                            </div>
                        </div>
                        @if($this->getViewData()['ticket']->category)
                        <div class="px-8 py-4 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                            <span class="text-lg font-medium">
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
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-blue-100">
                    <div class="flex items-center space-x-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-2xl">📅</span>
                        </div>
                        <div>
                            <p class="text-base uppercase tracking-wide text-blue-200">Créé le</p>
                            <p class="font-medium text-xl">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-2xl">🔄</span>
                        </div>
                        <div>
                            <p class="text-base uppercase tracking-wide text-blue-200">Dernière mise à jour</p>
                            <p class="font-medium text-xl">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->updated_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-2xl">💬</span>
                        </div>
                        <div>
                            <p class="text-base uppercase tracking-wide text-blue-200">Réponses</p>
                            <p class="font-medium text-xl">{{ $this->getViewData()['allResponses']->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message initial avec design élégant -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-12 py-8">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-white text-3xl">🎫</span>
                    </div>
                    <div>
                        <h3 class="text-3xl font-semibold text-white">Message initial du ticket</h3>
                        <p class="text-blue-100 text-xl">Première demande de l'utilisateur</p>
                    </div>
                </div>
            </div>
            
            <div class="p-12">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-3xl">
                            {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white text-2xl">
                                {{ $this->getViewData()['initialResponse']->user->username }}
                            </p>
                            <div class="flex items-center space-x-4 mt-3">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    👤 Client
                                </span>
                                <span class="text-lg text-gray-500">
                                    {{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 border border-gray-200 dark:border-gray-600">
                    <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-xl leading-relaxed">
                        {{ $this->getViewData()['initialResponse']->content }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Historique des réponses avec timeline moderne -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-12 py-8">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-white text-3xl">💬</span>
                    </div>
                    <div>
                        <h3 class="text-3xl font-semibold text-white">Conversation</h3>
                        <p class="text-gray-200 text-xl">Historique des échanges</p>
                    </div>
                </div>
            </div>
            
            <div class="p-12">
                @if($this->getViewData()['followUpResponses']->count() > 0)
                    <div class="space-y-12">
                        @foreach($this->getViewData()['followUpResponses'] as $response)
                        <div class="relative">
                            <!-- Timeline connector -->
                            <div class="absolute left-10 top-20 w-1.5 h-10 bg-gray-300 dark:bg-gray-600"></div>
                            
                            <div class="flex items-start space-x-8">
                                <div class="flex-shrink-0">
                                    <div class="w-20 h-20 rounded-full flex items-center justify-center text-white font-bold text-3xl {{ $response->is_staff_response 
                                        ? 'bg-gradient-to-br from-green-500 to-emerald-600' 
                                        : 'bg-gradient-to-br from-blue-500 to-purple-600' }}">
                                        {{ strtoupper(substr($response->user->username, 0, 2)) }}
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-6">
                                        <div class="flex items-center space-x-6">
                                            <p class="font-semibold text-gray-900 dark:text-white text-2xl">
                                                {{ $response->user->username }}
                                            </p>
                                            @if($response->is_staff_response)
                                                <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    👨‍💼 Support
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    👤 Client
                                                </span>
                                            @endif
                                            @if($response->is_internal)
                                                <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                                    🔒 Interne
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-lg text-gray-500">
                                            {{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}
                                        </span>
                                    </div>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 border border-gray-200 dark:border-gray-600">
                                        <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-xl leading-relaxed">
                                            {{ $response->content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20">
                        <div class="w-32 h-32 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-8">
                            <span class="text-gray-400 text-5xl">💬</span>
                        </div>
                        <h4 class="text-2xl font-medium text-gray-900 dark:text-white mb-4">Aucune réponse encore</h4>
                        <p class="text-gray-500 dark:text-gray-400 text-xl">Soyez le premier à répondre à ce ticket !</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formulaire de réponse avec design moderne -->
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-12 py-8">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-white text-3xl">✍️</span>
                    </div>
                    <div>
                        <h3 class="text-3xl font-semibold text-white">Ajouter une réponse</h3>
                        <p class="text-emerald-100 text-xl">Participez à la conversation</p>
                    </div>
                </div>
            </div>
            
            <div class="p-12">
                <form wire:submit="submit" class="space-y-12">
                    {{ $this->form }}
                    
                    <div class="flex justify-end">
                        <x-filament::button type="submit" size="lg" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 border-0 shadow-xl text-xl px-12 py-6">
                            <x-heroicon-o-paper-airplane class="w-8 h-8 mr-4" />
                            Envoyer la réponse
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-filament-panels::page>
