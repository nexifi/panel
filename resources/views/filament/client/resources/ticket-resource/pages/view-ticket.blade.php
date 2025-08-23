<x-filament-panels::page>
    <div class="w-full space-y-6">
        
        <!-- En-tête du ticket -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $this->getViewData()['ticket']->subject }}
                    </h1>
                    <p class="text-gray-600 mt-1">Ticket #{{ $this->getViewData()['ticket']->id }}</p>
                </div>
                <div class="flex gap-2">
                    <span class="px-3 py-1 text-sm font-medium rounded-lg {{ match($this->getViewData()['ticket']->status) {
                        'open' => 'bg-green-100 text-green-800',
                        'in_progress' => 'bg-blue-100 text-blue-800',
                        'waiting' => 'bg-yellow-100 text-yellow-800',
                        'closed' => 'bg-gray-100 text-gray-800',
                    } }}">
                        {{ match($this->getViewData()['ticket']->status) {
                            'open' => 'Ouvert',
                            'in_progress' => 'En cours',
                            'waiting' => 'En attente',
                            'closed' => 'Fermé',
                        } }}
                    </span>
                    <span class="px-3 py-1 text-sm font-medium rounded-lg {{ match($this->getViewData()['ticket']->priority) {
                        'low' => 'bg-gray-100 text-gray-800',
                        'medium' => 'bg-yellow-100 text-yellow-800',
                        'high' => 'bg-orange-100 text-orange-800',
                        'urgent' => 'bg-red-100 text-red-800',
                    } }}">
                        {{ match($this->getViewData()['ticket']->priority) {
                            'low' => 'Faible',
                            'medium' => 'Moyenne',
                            'high' => 'Haute',
                            'urgent' => 'Urgente',
                        } }}
                    </span>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-gray-200">
                <div class="text-center md:text-left p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Créé le</p>
                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->created_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-center md:text-left p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Mis à jour</p>
                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->updated_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-center md:text-left p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Réponses</p>
                    <p class="font-semibold text-gray-900">{{ $this->getViewData()['allResponses']->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Message initial -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Message initial</h2>
            </div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-900">{{ $this->getViewData()['initialResponse']->user->username }}</span>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Client</span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="bg-gray-50 rounded p-4">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $this->getViewData()['initialResponse']->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Conversation -->
        @if($this->getViewData()['followUpResponses']->count() > 0)
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Conversation</h2>
            </div>
            <div class="p-6 space-y-4">
                @foreach($this->getViewData()['followUpResponses'] as $response)
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 {{ $response->is_staff_response ? 'bg-green-500' : 'bg-blue-500' }} rounded-lg flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($response->user->username, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-900">{{ $response->user->username }}</span>
                            <span class="text-xs {{ $response->is_staff_response ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }} px-2 py-1 rounded">
                                {{ $response->is_staff_response ? 'Support' : 'Client' }}
                            </span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="bg-gray-50 rounded p-4">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $response->content }}</p>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <hr class="border-gray-200">
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Formulaire de réponse -->
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Ajouter une réponse</h2>
            </div>
            <div class="p-6">
                <form wire:submit="submit" class="space-y-4">
                    {{ $this->form }}
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>
</x-filament-panels::page>