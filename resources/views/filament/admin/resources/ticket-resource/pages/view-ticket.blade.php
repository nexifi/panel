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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
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
                        'server' => 'Serveur',
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

        <!-- Historique des réponses -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                Historique des réponses
            </h3>

            <div class="space-y-4">
                @foreach($this->getViewData()['responses'] as $response)
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
