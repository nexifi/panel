<x-filament-panels::page>
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- En-tête du ticket avec design moderne -->
        <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-xl">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative p-8 text-white">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $this->record->subject }}</h1>
                        <p class="text-indigo-100 text-lg">Ticket #{{ $this->record->id }}</p>
                    </div>
                    <div class="flex flex-col items-end space-y-3">
                        <div class="flex space-x-3">
                            <div class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                                <span class="text-sm font-medium">
                                    {{ match($this->record->status) {
                                        'open' => '🔓 Ouvert',
                                        'in_progress' => '⚡ En cours',
                                        'waiting' => '⏳ En attente',
                                        'closed' => '🔒 Fermé',
                                    } }}
                                </span>
                            </div>
                            <div class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                                <span class="text-sm font-medium">
                                    {{ match($this->record->priority) {
                                        'low' => '🟢 Faible',
                                        'medium' => '🟡 Moyenne',
                                        'high' => '🟠 Haute',
                                        'urgent' => '🔴 Urgente',
                                    } }}
                                </span>
                            </div>
                        </div>
                        @if($this->record->category)
                        <div class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
                            <span class="text-sm font-medium">
                                {{ match($this->record->category) {
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
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-indigo-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">👤</span>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide">Utilisateur</p>
                            <p class="font-medium">{{ $this->record->user->username }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">📅</span>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide">Créé le</p>
                            <p class="font-medium">{{ $this->record->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">🔄</span>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide">Dernière mise à jour</p>
                            <p class="font-medium">{{ $this->record->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">💬</span>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide">Réponses</p>
                            <p class="font-medium">{{ $this->getViewData()['allResponses']->count() }}</p>
                        </div>
                    </div>
                </div>
                
                @if($this->record->assignedUser)
                <div class="mt-6 pt-6 border-t border-white/20">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-white text-lg">👨‍💼</span>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-indigo-200">Assigné à</p>
                            <p class="font-medium text-lg">{{ $this->record->assignedUser->username }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Message initial avec design élégant -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-white text-xl">🎫</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Message initial du ticket</h3>
                        <p class="text-blue-100 text-sm">Première demande de l'utilisateur</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white text-lg">
                                {{ $this->getViewData()['initialResponse']->user->username }}
                            </p>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    👤 Client
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600">
                    <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-base leading-relaxed">
                        {{ $this->getViewData()['initialResponse']->content }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Historique des réponses avec timeline moderne -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-white text-xl">💬</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Conversation</h3>
                        <p class="text-gray-200 text-sm">Historique des échanges</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                @if($this->getViewData()['followUpResponses']->count() > 0)
                    <div class="space-y-6">
                        @foreach($this->getViewData()['followUpResponses'] as $response)
                        <div class="relative">
                            <!-- Timeline connector -->
                            <div class="absolute left-6 top-12 w-0.5 h-6 bg-gray-300 dark:bg-gray-600"></div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg {{ $response->is_staff_response 
                                        ? 'bg-gradient-to-br from-green-500 to-emerald-600' 
                                        : 'bg-gradient-to-br from-blue-500 to-purple-600' }}">
                                        {{ strtoupper(substr($response->user->username, 0, 2)) }}
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3">
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ $response->user->username }}
                                            </p>
                                            @if($response->is_staff_response)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    👨‍💼 Équipe
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    👤 Client
                                                </span>
                                            @endif
                                            @if($response->is_internal)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                                    🔒 Interne
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}
                                        </span>
                                    </div>
                                    
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600">
                                        <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-base leading-relaxed">
                                            {{ $response->content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-gray-400 text-3xl">💬</span>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Aucune réponse encore</h4>
                        <p class="text-gray-500 dark:text-gray-400">Soyez le premier à répondre à ce ticket !</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formulaire de réponse avec design moderne -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-white text-xl">✍️</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white">Ajouter une réponse</h3>
                        <p class="text-emerald-100 text-sm">Participez à la conversation</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <form wire:submit="submitResponse" class="space-y-6">
                    {{ $this->form }}

                    <div class="flex justify-end">
                        <x-filament::button type="submit" size="lg" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 border-0 shadow-lg">
                            <x-heroicon-o-paper-airplane class="w-5 h-5 mr-2" />
                            Envoyer la réponse
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-filament-panels::page>
