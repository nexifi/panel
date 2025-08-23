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

        <!-- Chatbox des messages -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                💬 Conversation du ticket
            </h3>
            
            <div class="space-y-4 max-h-96 overflow-y-auto">
                @if($this->getViewData()['allResponses']->count() > 0)
                    @foreach($this->getViewData()['allResponses'] as $response)
                        @php
                            $isCurrentUser = $response->user_id === auth()->id();
                            $isStaff = $response->is_staff_response;
                        @endphp
                        
                        <div class="flex {{ $isCurrentUser ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md">
                                <!-- Message -->
                                <div class="relative">
                                    <div class="px-4 py-2 rounded-2xl {{ $isCurrentUser 
                                        ? 'bg-blue-500 text-white rounded-br-md' 
                                        : ($isStaff 
                                            ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-bl-md' 
                                            : 'bg-green-200 dark:bg-green-700 text-gray-900 dark:text-white rounded-bl-md') }}">
                                        <div class="text-sm whitespace-pre-wrap">{{ $response->content }}</div>
                                    </div>
                                    
                                    <!-- Flèche du message -->
                                    @if($isCurrentUser)
                                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-blue-500 transform rotate-45 translate-x-1 translate-y-1"></div>
                                    @else
                                        <div class="absolute bottom-0 left-0 w-3 h-3 {{ $isStaff ? 'bg-gray-200 dark:bg-gray-700' : 'bg-green-200 dark:bg-green-700' }} transform rotate-45 -translate-x-1 translate-y-1"></div>
                                    @endif
                                </div>
                                
                                <!-- Informations du message -->
                                <div class="mt-1 px-2 text-xs text-gray-500 dark:text-gray-400 {{ $isCurrentUser ? 'text-right' : 'text-left' }}">
                                    <span class="font-medium">
                                        @if($isCurrentUser)
                                            Vous
                                        @elseif($isStaff)
                                            👨‍💼 Support
                                        @else
                                            {{ $response->user->username }}
                                        @endif
                                    </span>
                                    <span class="mx-2">•</span>
                                    <span>{{ \Carbon\Carbon::parse($response->created_at)->format('H:i') }}</span>
                                    @if($response->is_internal)
                                        <span class="mx-2">•</span>
                                        <span class="text-orange-500">🔒 Interne</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-gray-400 text-2xl">💬</span>
                        </div>
                        <p>Aucun message dans ce ticket.</p>
                        <p class="text-sm mt-1">Commencez la conversation !</p>
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
