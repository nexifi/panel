<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Informations du ticket -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $this->getViewData()['ticket']->subject }}
                </h2>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($this->getViewData()['ticket']->status === 'open') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                        @elseif($this->getViewData()['ticket']->status === 'in_progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                        @elseif($this->getViewData()['ticket']->status === 'waiting') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                        @endif">
                        @if($this->getViewData()['ticket']->status === 'open') Ouvert
                        @elseif($this->getViewData()['ticket']->status === 'in_progress') En cours
                        @elseif($this->getViewData()['ticket']->status === 'waiting') En attente
                        @else Fermé
                        @endif
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($this->getViewData()['ticket']->priority === 'urgent') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                        @elseif($this->getViewData()['ticket']->priority === 'high') bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200
                        @elseif($this->getViewData()['ticket']->priority === 'medium') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                        @endif">
                        @if($this->getViewData()['ticket']->priority === 'urgent') Urgente
                        @elseif($this->getViewData()['ticket']->priority === 'high') Haute
                        @elseif($this->getViewData()['ticket']->priority === 'medium') Moyenne
                        @else Basse
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-400">
                <div>
                    <span class="font-medium">Créé le :</span>
                    {{ $this->getViewData()['ticket']->created_at->format('d/m/Y à H:i') }}
                </div>
                @if($this->getViewData()['ticket']->category)
                <div>
                    <span class="font-medium">Catégorie :</span>
                    {{ ucfirst($this->getViewData()['ticket']->category) }}
                </div>
                @endif
                <div>
                    <span class="font-medium">Dernière mise à jour :</span>
                    {{ $this->getViewData()['ticket']->updated_at->format('d/m/Y à H:i') }}
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
                        <span class="text-sm text-gray-500">
                            {{ $this->getViewData()['initialResponse']->created_at->format('d/m/Y à H:i') }}
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
                    <div class="border-l-4 border-blue-500 pl-4 py-2
                        @if($response->is_staff_response) border-green-500 @endif">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-900 dark:text-white">
                                    @if($response->is_staff_response)
                                        <span class="text-green-600 dark:text-green-400">👨‍💼 Support</span>
                                    @else
                                        <span class="text-blue-600 dark:text-blue-400">👤 Vous</span>
                                    @endif
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $response->created_at->format('d/m/Y à H:i') }}
                                </span>
                            </div>
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
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                Ajouter une réponse
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
