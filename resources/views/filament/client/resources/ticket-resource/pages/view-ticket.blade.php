<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Informations du ticket -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $this->getViewData()['ticket']->subject }}
                </h2>
                <div class="flex items-center space-x-3">
                    <x-filament::badge :color="$this->getViewData()['ticket']->status === 'open' ? 'success' : ($this->getViewData()['ticket']->status === 'in_progress' ? 'warning' : ($this->getViewData()['ticket']->status === 'waiting' ? 'info' : 'danger'))">
                        {{ match($this->getViewData()['ticket']->status) {
                            'open' => 'Ouvert',
                            'in_progress' => 'En cours',
                            'waiting' => 'En attente',
                            'closed' => 'Fermé',
                        } }}
                    </x-filament::badge>
                    <x-filament::badge :color="$this->getViewData()['ticket']->priority === 'low' ? 'success' : ($this->getViewData()['ticket']->priority === 'medium' ? 'info' : ($this->getViewData()['ticket']->priority === 'high' ? 'warning' : 'danger'))">
                        {{ match($this->getViewData()['ticket']->priority) {
                            'low' => 'Basse',
                            'medium' => 'Moyenne',
                            'high' => 'Haute',
                            'urgent' => 'Urgente',
                        } }}
                    </x-filament::badge>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-400">
                <div>
                    <span class="font-medium">Créé le :</span>
                    <span class="ml-2">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->created_at)->format('d/m/Y H:i') }}</span>
                </div>
                @if($this->getViewData()['ticket']->category)
                <div>
                    <span class="font-medium">Catégorie :</span>
                    <span class="ml-2">{{ match($this->getViewData()['ticket']->category) {
                        'general' => 'Général',
                        'technical' => 'Technique',
                        'billing' => 'Facturation',
                        'bug' => 'Bug',
                        'feature' => 'Fonctionnalité',
                        'other' => 'Autre',
                    } }}</span>
                </div>
                @endif
                <div>
                    <span class="font-medium">Dernière mise à jour :</span>
                    <span class="ml-2">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->updated_at)->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Message initial du ticket -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
            <div class="flex items-center mb-3">
                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center mr-3">
                    <span class="text-blue-600 dark:text-blue-400 text-sm font-bold">🎫</span>
                </div>
                <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">
                    Message initial du ticket
                </h3>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-blue-200 dark:border-blue-700">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-2">
                        <span class="font-medium text-gray-900 dark:text-white">
                            {{ $this->getViewData()['initialResponse']->user->username }}
                        </span>
                        <x-filament::badge color="success" size="sm">Client</x-filament::badge>
                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>
                <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-sm leading-relaxed">
                    {{ $this->getViewData()['initialResponse']->content }}
                </div>
            </div>
        </div>
        @endif

        <!-- Historique des réponses -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                📝 Historique des réponses
            </h3>
            
            <div class="space-y-4">
                @if($this->getViewData()['followUpResponses']->count() > 0)
                    @foreach($this->getViewData()['followUpResponses'] as $response)
                    <div class="border-l-4 {{ $response->is_staff_response ? 'border-green-500' : 'border-blue-500' }} pl-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-r-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-900 dark:text-white">
                                    {{ $response->user->username }}
                                </span>
                                @if($response->is_staff_response)
                                    <x-filament::badge color="info" size="sm">👨‍💼 Support</x-filament::badge>
                                @else
                                    <x-filament::badge color="success" size="sm">👤 Client</x-filament::badge>
                                @endif
                                @if($response->is_internal)
                                    <x-filament::badge color="warning" size="sm">🔒 Interne</x-filament::badge>
                                @endif
                            </div>
                            <span class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap bg-white dark:bg-gray-800 p-3 rounded border">
                            {{ $response->content }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-gray-400 text-2xl">💬</span>
                        </div>
                        <p>Aucune réponse n'a encore été donnée à ce ticket.</p>
                        <p class="text-sm mt-1">Soyez le premier à répondre !</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Formulaire de réponse -->
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                ✍️ Ajouter une réponse
            </h3>
            
            <form wire:submit="submit" class="space-y-4">
                {{ $this->form }}
                
                <div class="flex justify-end">
                    <x-filament::button type="submit" color="primary">
                        <x-heroicon-o-paper-airplane class="w-4 h-4 mr-2" />
                        Envoyer la réponse
                    </x-filament::button>
                </div>
            </form>
        </div>
        @endif
    </div>
</x-filament-panels::page>
