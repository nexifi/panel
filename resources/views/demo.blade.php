<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démonstration - Création de Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-gray-900">🎫 Démonstration - Création de Ticket</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/client" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">
                            Retour au Panel Client
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Comment créer un ticket</h2>
                
                <div class="space-y-6">
                    <!-- Étape 1 -->
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">1. Accédez au Panel Client</h3>
                        <p class="text-gray-600 mb-3">
                            Connectez-vous à votre espace client via <code class="bg-gray-100 px-2 py-1 rounded">/client</code>
                        </p>
                        <div class="bg-blue-50 border border-blue-200 rounded p-3">
                            <p class="text-blue-800 text-sm">
                                <strong>Note :</strong> Vous devez être connecté pour créer des tickets
                            </p>
                        </div>
                    </div>

                    <!-- Étape 2 -->
                    <div class="border-l-4 border-green-500 pl-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">2. Cliquez sur "Nouveau Ticket"</h3>
                        <p class="text-gray-600 mb-3">
                            Utilisez le bouton "Nouveau Ticket" ou naviguez vers <code class="bg-gray-100 px-2 py-1 rounded">/client/tickets/create</code>
                        </p>
                    </div>

                    <!-- Étape 3 -->
                    <div class="border-l-4 border-purple-500 pl-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">3. Remplissez le formulaire</h3>
                        <div class="bg-gray-50 rounded p-4 space-y-3">
                            <div>
                                <strong class="text-gray-900">Sujet :</strong>
                                <span class="text-gray-600">Titre court et descriptif de votre problème</span>
                            </div>
                            <div>
                                <strong class="text-gray-900">Priorité :</strong>
                                <span class="text-gray-600">Choisissez selon l'urgence (Basse, Moyenne, Haute, Urgente)</span>
                            </div>
                            <div>
                                <strong class="text-gray-900">Catégorie :</strong>
                                <span class="text-gray-600">Type de problème (Technique, Facturation, Général, Bug, Fonctionnalité)</span>
                            </div>
                            <div>
                                <strong class="text-gray-900">Message :</strong>
                                <span class="text-gray-600">Description détaillée de votre problème (minimum 10 caractères)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Étape 4 -->
                    <div class="border-l-4 border-orange-500 pl-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">4. Soumettez votre ticket</h3>
                        <p class="text-gray-600 mb-3">
                            Cliquez sur "Créer" pour envoyer votre ticket. Vous recevrez une confirmation.
                        </p>
                    </div>

                    <!-- Conseils -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-yellow-900 mb-3">💡 Conseils pour un bon ticket</h3>
                        <ul class="text-yellow-800 space-y-2 text-sm">
                            <li>• <strong>Soyez précis</strong> dans votre description</li>
                            <li>• <strong>Incluez les étapes</strong> pour reproduire le problème</li>
                            <li>• <strong>Mentionnez les messages d'erreur</strong> si applicable</li>
                            <li>• <strong>Précisez votre environnement</strong> (navigateur, système d'exploitation, etc.)</li>
                            <li>• <strong>Une image vaut mille mots</strong> - ajoutez des captures d'écran si possible</li>
                        </ul>
                    </div>

                    <!-- Exemple de bon ticket -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-green-900 mb-3">✅ Exemple de bon ticket</h3>
                        <div class="bg-white rounded p-3 space-y-2 text-sm">
                            <div><strong>Sujet :</strong> Impossible de me connecter à mon serveur Minecraft</div>
                            <div><strong>Priorité :</strong> Haute</div>
                            <div><strong>Catégorie :</strong> Problème technique</div>
                            <div><strong>Message :</strong></div>
                            <div class="bg-gray-100 p-2 rounded text-gray-700">
                                Bonjour,<br><br>
                                Je n'arrive plus à me connecter à mon serveur Minecraft depuis hier soir. Voici les détails :<br><br>
                                • <strong>Nom du serveur :</strong> MonServeur<br>
                                • <strong>Adresse IP :</strong> 192.168.1.100<br>
                                • <strong>Port :</strong> 25565<br>
                                • <strong>Message d'erreur :</strong> "Connection refused"<br>
                                • <strong>Dernière connexion réussie :</strong> Hier à 18h30<br><br>
                                J'ai vérifié que mon pare-feu n'a pas changé et que mon réseau fonctionne normalement. Pouvez-vous vérifier l'état du serveur ?<br><br>
                                Merci d'avance pour votre aide.
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-center space-x-4 pt-6">
                        <a href="/client" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Accéder au Panel Client
                        </a>
                        <a href="/client/tickets/create" class="bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors">
                            Créer un Ticket Maintenant
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
