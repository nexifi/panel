<x-filament-panels::page>
    <div class="w-full space-y-6">
        
        <!-- En-tête du ticket avec glassmorphism subtil -->
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $this->getViewData()['ticket']->subject }}
                    </h1>
                    <p class="text-gray-600 mt-1">Ticket #{{ $this->getViewData()['ticket']->id }}</p>
                </div>
                <div class="flex gap-2">
                    <span class="px-3 py-1 text-sm font-medium rounded-lg backdrop-blur-sm {{ match($this->getViewData()['ticket']->status) {
                        'open' => 'bg-green-100/80 text-green-800 border border-green-200/50',
                        'in_progress' => 'bg-blue-100/80 text-blue-800 border border-blue-200/50',
                        'waiting' => 'bg-yellow-100/80 text-yellow-800 border border-yellow-200/50',
                        'closed' => 'bg-gray-100/80 text-gray-800 border border-gray-200/50',
                    } }}">
                        {{ match($this->getViewData()['ticket']->status) {
                            'open' => 'Ouvert',
                            'in_progress' => 'En cours',
                            'waiting' => 'En attente',
                            'closed' => 'Fermé',
                        } }}
                    </span>
                    <span class="px-3 py-1 text-sm font-medium rounded-lg backdrop-blur-sm {{ match($this->getViewData()['ticket']->priority) {
                        'low' => 'bg-gray-100/80 text-gray-800 border border-gray-200/50',
                        'medium' => 'bg-yellow-100/80 text-yellow-800 border border-yellow-200/50',
                        'high' => 'bg-orange-100/80 text-orange-800 border border-orange-200/50',
                        'urgent' => 'bg-red-100/80 text-red-800 border border-red-200/50',
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
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-gray-200/50">
                <div class="text-center md:text-left p-4 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Créé le</p>
                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->created_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-center md:text-left p-4 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Mis à jour</p>
                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($this->getViewData()['ticket']->updated_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-center md:text-left p-4 bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg">
                    <p class="text-sm text-gray-600 mb-1">Réponses</p>
                    <p class="font-semibold text-gray-900">{{ $this->getViewData()['allResponses']->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Message initial avec glassmorphism subtil -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200/50">
                <h2 class="text-lg font-medium text-gray-900">Message initial</h2>
            </div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                        {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-900">{{ $this->getViewData()['initialResponse']->user->username }}</span>
                            <span class="text-xs bg-blue-100/80 text-blue-800 backdrop-blur-sm border border-blue-200/50 px-2 py-1 rounded">Client</span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded p-4">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $this->getViewData()['initialResponse']->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Conversation avec glassmorphism subtil -->
        @if($this->getViewData()['followUpResponses']->count() > 0)
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200/50">
                <h2 class="text-lg font-medium text-gray-900">Conversation</h2>
            </div>
            <div class="p-6 space-y-4">
                @foreach($this->getViewData()['followUpResponses'] as $response)
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 {{ $response->is_staff_response ? 'bg-green-500' : 'bg-blue-500' }} rounded-lg flex items-center justify-center text-white font-bold shadow-md">
                        {{ strtoupper(substr($response->user->username, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold text-gray-900">{{ $response->user->username }}</span>
                            <span class="text-xs backdrop-blur-sm border px-2 py-1 rounded {{ $response->is_staff_response ? 'bg-green-100/80 text-green-800 border-green-200/50' : 'bg-blue-100/80 text-blue-800 border-blue-200/50' }}">
                                {{ $response->is_staff_response ? 'Support' : 'Client' }}
                            </span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded p-4">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $response->content }}</p>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <hr class="border-gray-200/50">
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Formulaire de réponse avec glassmorphism subtil -->
        @if($this->getViewData()['ticket']->isOpen())
        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200/50">
                <h2 class="text-lg font-medium text-gray-900">Ajouter une réponse</h2>
            </div>
            <div class="p-6">
                <form wire:submit="submit" class="space-y-4">
                    <div class="bg-gray-50/80 backdrop-blur-sm border border-gray-100/50 rounded-lg p-4">
                        {{ $this->form }}
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors shadow-md hover:shadow-lg">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>
</x-filament-panels::page>