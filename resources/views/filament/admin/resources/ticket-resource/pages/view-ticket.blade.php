<x-filament-panels::page>
    <div class="w-full space-y-6">
        
        <!-- En-tête moderne avec glassmorphism -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $this->record->subject }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">Ticket #{{ $this->record->id }}</p>
                </div>
                <div class="flex gap-3">
                    <span class="px-4 py-2 text-sm font-semibold backdrop-blur-sm border rounded-lg {{ match($this->record->status) {
                        'open' => 'bg-green-500/20 text-green-700 border-green-300/50',
                        'in_progress' => 'bg-blue-500/20 text-blue-700 border-blue-300/50',
                        'waiting' => 'bg-yellow-500/20 text-yellow-700 border-yellow-300/50',
                        'closed' => 'bg-gray-500/20 text-gray-700 border-gray-300/50',
                    } }}">
                        {{ match($this->record->status) {
                            'open' => 'Ouvert',
                            'in_progress' => 'En cours',
                            'waiting' => 'En attente',
                            'closed' => 'Fermé',
                        } }}
                    </span>
                    <span class="px-4 py-2 text-sm font-semibold backdrop-blur-sm border rounded-lg {{ match($this->record->priority) {
                        'low' => 'bg-gray-500/20 text-gray-700 border-gray-300/50',
                        'medium' => 'bg-yellow-500/20 text-yellow-700 border-yellow-300/50',
                        'high' => 'bg-orange-500/20 text-orange-700 border-orange-300/50',
                        'urgent' => 'bg-red-500/20 text-red-700 border-red-300/50',
                    } }}">
                        {{ match($this->record->priority) {
                            'low' => 'Faible',
                            'medium' => 'Moyenne',
                            'high' => 'Haute',
                            'urgent' => 'Urgente',
                        } }}
                    </span>
                </div>
            </div>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 pt-8 border-t border-gray-200/50 dark:border-gray-600/50">
                <div class="group text-center md:text-left p-6 bg-gradient-to-br from-blue-50/80 to-indigo-50/80 dark:from-blue-900/20 dark:to-indigo-900/20 backdrop-blur-sm border border-blue-200/50 dark:border-blue-700/50 rounded-xl hover:shadow-lg transition-all duration-300">
                    <p class="text-sm text-blue-600/80 dark:text-blue-400 mb-2 font-medium">Créé le</p>
                    <p class="font-bold text-xl text-blue-900 dark:text-blue-100">{{ \Carbon\Carbon::parse($this->record->created_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="group text-center md:text-left p-6 bg-gradient-to-br from-emerald-50/80 to-teal-50/80 dark:from-emerald-900/20 dark:to-teal-900/20 backdrop-blur-sm border border-emerald-200/50 dark:border-emerald-700/50 rounded-xl hover:shadow-lg transition-all duration-300">
                    <p class="text-sm text-emerald-600/80 dark:text-emerald-400 mb-2 font-medium">Mis à jour</p>
                    <p class="font-bold text-xl text-emerald-900 dark:text-emerald-100">{{ \Carbon\Carbon::parse($this->record->updated_at)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="group text-center md:text-left p-6 bg-gradient-to-br from-purple-50/80 to-pink-50/80 dark:from-purple-900/20 dark:to-pink-900/20 backdrop-blur-sm border border-purple-200/50 dark:border-purple-700/50 rounded-xl hover:shadow-lg transition-all duration-300">
                    <p class="text-sm text-purple-600/80 dark:text-purple-400 mb-2 font-medium">Réponses</p>
                    <p class="font-bold text-xl text-purple-900 dark:text-purple-100">{{ $this->getViewData()['allResponses']->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Message initial avec glassmorphism -->
        @if($this->getViewData()['initialResponse'])
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500/10 to-indigo-500/10 px-8 py-6 border-b border-blue-200/30 dark:border-blue-700/30">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">💭</span>
                    Message initial
                </h2>
            </div>
            <div class="p-8">
                <div class="flex items-start gap-8">
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            {{ strtoupper(substr($this->getViewData()['initialResponse']->user->username, 0, 2)) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-lg border-2 border-white flex items-center justify-center">
                            <span class="text-xs">👤</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $this->getViewData()['initialResponse']->user->username }}</span>
                            <span class="bg-blue-500/20 text-blue-700 dark:text-blue-300 px-3 py-1 rounded-lg text-sm font-semibold backdrop-blur-sm border border-blue-300/50">Client</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($this->getViewData()['initialResponse']->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50/80 to-blue-50/60 dark:from-gray-700/80 dark:to-blue-900/20 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-6">
                            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-wrap text-lg leading-relaxed">{{ $this->getViewData()['initialResponse']->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Conversation avec glassmorphism -->
        @if($this->getViewData()['followUpResponses']->count() > 0)
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-gray-500/10 to-slate-500/10 px-8 py-6 border-b border-gray-200/30 dark:border-gray-700/30">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 bg-gray-500/20 rounded-lg flex items-center justify-center">💬</span>
                    Conversation
                </h2>
            </div>
            <div class="p-8 space-y-6">
                @foreach($this->getViewData()['followUpResponses'] as $response)
                <div class="group flex items-start gap-8 p-6 {{ $response->is_staff_response ? 'bg-gradient-to-br from-green-50/60 to-emerald-50/40 dark:from-green-900/20 dark:to-emerald-900/10' : 'bg-gradient-to-br from-blue-50/60 to-indigo-50/40 dark:from-blue-900/20 dark:to-indigo-900/10' }} backdrop-blur-sm border {{ $response->is_staff_response ? 'border-green-200/50 dark:border-green-700/30' : 'border-blue-200/50 dark:border-blue-700/30' }} rounded-xl hover:shadow-lg transition-all duration-300">
                    <div class="relative">
                        <div class="w-16 h-16 {{ $response->is_staff_response ? 'bg-gradient-to-br from-green-500 to-emerald-600' : 'bg-gradient-to-br from-blue-500 to-indigo-600' }} rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            {{ strtoupper(substr($response->user->username, 0, 2)) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 {{ $response->is_staff_response ? 'bg-emerald-500' : 'bg-blue-500' }} rounded-lg border-2 border-white flex items-center justify-center">
                            <span class="text-xs">{{ $response->is_staff_response ? '👨‍💼' : '👤' }}</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $response->user->username }}</span>
                            <span class="px-3 py-1 rounded-lg text-sm font-semibold backdrop-blur-sm border {{ $response->is_staff_response ? 'bg-green-500/20 text-green-700 dark:text-green-300 border-green-300/50' : 'bg-blue-500/20 text-blue-700 dark:text-blue-300 border-blue-300/50' }}">
                                {{ $response->is_staff_response ? 'Support' : 'Client' }}
                            </span>
                            <span class="text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($response->created_at)->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-6">
                            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-wrap text-lg leading-relaxed">{{ $response->content }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Formulaire de réponse avec glassmorphism -->
        @if($this->record->isOpen())
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 px-8 py-6 border-b border-emerald-200/30 dark:border-emerald-700/30">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <span class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center">✍️</span>
                    Ajouter une réponse
                </h2>
            </div>
            <div class="p-8">
                <form wire:submit="submit" class="space-y-6">
                    <div class="bg-gradient-to-br from-gray-50/80 to-emerald-50/60 dark:from-gray-700/80 dark:to-emerald-900/20 backdrop-blur-sm border border-gray-200/50 dark:border-gray-600/50 rounded-xl p-6">
                        {{ $this->form }}
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="group bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 backdrop-blur-sm">
                            <span class="flex items-center gap-2">
                                Envoyer
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </div>
</x-filament-panels::page>