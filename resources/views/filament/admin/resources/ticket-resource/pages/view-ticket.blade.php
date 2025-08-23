<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Informations du ticket -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $this->record->subject }}
                </h2>
                <div class="flex items-center space-x-2">
                    <x-filament::badge :color="$this->record->status === 'open' ? 'success' : ($this->record->status === 'in_progress' ? 'warning' : ($this->record->status === 'waiting' ? 'info' : 'danger'))">
                        {{ match($this->record->status) {
                            'open' => 'Ouvert',
                            'in_progress' => 'En cours',
                            'waiting' => 'En attente',
                            'closed' => 'Fermé',
                        } }}
                    </x-filament::badge>
                    <x-filament::badge :color="$this->record->priority === 'low' ? 'success' : ($this->record->priority === 'medium' ? 'info' : ($this->record->priority === 'high' ? 'warning' : 'danger'))">
                        {{ match($this->record->priority) {
                            'low' => 'Faible',
                            'medium' => 'Moyenne',
                            'high' => 'Élevée',
                            'urgent' => 'Urgente',
                        } }}
                    </x-filament::badge>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4">
                <div>
                    <span class="font-medium">Utilisateur:</span>
                    <span class="ml-2">{{ $this->record->user->username }}</span>
                </div>
                <div>
                    <span class="font-medium">Catégorie:</span>
                    <span class="ml-2">{{ $this->record->category ? match($this->record->category) {
                        'general' => 'Général',
                        'technical' => 'Technique',
                        'billing' => 'Facturation',
                        'bug' => 'Bug',
                        'feature' => 'Fonctionnalité',
                        'other' => 'Autre',
                    } : 'Non définie' }}</span>
                </div>
                <div>
                    <span class="font-medium">Assigné à:</span>
                    <span class="ml-2">{{ $this->record->assignedUser?->username ?? 'Non assigné' }}</span>
                </div>
                <div>
                    <span class="font-medium">Créé le:</span>
                    <span class="ml-2">{{ $this->record->created_at->format('d/m/Y H:i') }}</span>
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
                            {{ $this->getViewData()['initialResponse']->created_at->format('d/m/Y H:i') }}
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
                Historique des réponses
            </h3>

            <div class="space-y-4">
                @if($this->getViewData()['followUpResponses']->count() > 0)
                    @foreach($this->getViewData()['followUpResponses'] as $response)
                        <div class="border-l-4 {{ $response->is_staff_response ? 'border-blue-500' : 'border-green-500' }} pl-4 py-2">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium text-gray-900 dark:text-white">
                                        {{ $response->user->username }}
                                    </span>
                                    @if($response->is_staff_response)
                                        <x-filament::badge color="info" size="sm">Équipe</x-filament::badge>
                                    @else
                                        <x-filament::badge color="success" size="sm">Utilisateur</x-filament::badge>
                                    @endif
                                    @if($response->is_internal)
                                        <x-filament::badge color="warning" size="sm">Interne</x-filament::badge>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-500">
                                    {{ $response->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                            <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
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
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                Ajouter une réponse
            </h3>

            <form wire:submit="submitResponse" class="space-y-4">
                {{ $this->form }}

                <div class="flex justify-end">
                    <x-filament::button type="submit" color="primary">
                        Envoyer la réponse
                    </x-filament::button>
                </div>
            </form>
        </div>
    </div>
</x-filament-panels::page>
