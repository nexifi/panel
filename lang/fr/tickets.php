<?php

return [
    'tickets' => 'Tickets',
    'ticket' => 'Ticket',
    'create_ticket' => 'Créer un ticket',
    'edit_ticket' => 'Modifier le ticket',
    'view_ticket' => 'Voir le ticket',
    'delete_ticket' => 'Supprimer le ticket',
    
    'subject' => 'Sujet',
    'status' => 'Statut',
    'priority' => 'Priorité',
    'category' => 'Catégorie',
    'assigned_to' => 'Assigné à',
    'user' => 'Utilisateur',
    'created_at' => 'Créé le',
    'updated_at' => 'Modifié le',
    'closed_at' => 'Fermé le',
    'closed_by' => 'Fermé par',
    'responses' => 'Réponses',
    'response' => 'Réponse',
    
    'statuses' => [
        'open' => 'Ouvert',
        'in_progress' => 'En cours',
        'waiting' => 'En attente',
        'closed' => 'Fermé',
    ],
    
    'priorities' => [
        'low' => 'Faible',
        'medium' => 'Moyenne',
        'high' => 'Élevée',
        'urgent' => 'Urgente',
    ],
    
    'categories' => [
        'general' => 'Général',
        'technical' => 'Technique',
        'billing' => 'Facturation',
        'server' => 'Serveur',
        'other' => 'Autre',
    ],
    
    'actions' => [
        'close' => 'Fermer',
        'reopen' => 'Rouvrir',
        'assign' => 'Assigner',
        'reply' => 'Répondre',
        'add_response' => 'Ajouter une réponse',
        'send_response' => 'Envoyer la réponse',
    ],
    
    'messages' => [
        'ticket_created' => 'Ticket créé avec succès',
        'ticket_updated' => 'Ticket mis à jour avec succès',
        'ticket_deleted' => 'Ticket supprimé avec succès',
        'ticket_closed' => 'Ticket fermé avec succès',
        'ticket_reopened' => 'Ticket rouvert avec succès',
        'response_sent' => 'Réponse envoyée avec succès',
        'ticket_assigned' => 'Ticket assigné avec succès',
    ],
    
    'confirmations' => [
        'close_ticket' => 'Êtes-vous sûr de vouloir fermer ce ticket ?',
        'reopen_ticket' => 'Êtes-vous sûr de vouloir rouvrir ce ticket ?',
        'delete_ticket' => 'Êtes-vous sûr de vouloir supprimer ce ticket ?',
        'close_selected' => 'Êtes-vous sûr de vouloir fermer les tickets sélectionnés ?',
    ],
    
    'filters' => [
        'all_tickets' => 'Tous les tickets',
        'open_tickets' => 'Tickets ouverts',
        'closed_tickets' => 'Tickets fermés',
        'my_tickets' => 'Mes tickets',
        'unassigned_tickets' => 'Tickets non assignés',
    ],
    
    'stats' => [
        'total_tickets' => 'Total des tickets',
        'open_tickets' => 'Tickets ouverts',
        'closed_tickets' => 'Tickets fermés',
        'urgent_tickets' => 'Tickets urgents',
        'tickets_today' => 'Tickets créés aujourd\'hui',
    ],
    
    'response_form' => [
        'content' => 'Votre réponse',
        'content_placeholder' => 'Tapez votre réponse ici...',
        'is_internal' => 'Note interne (visible uniquement par l\'équipe)',
        'is_staff_response' => 'Réponse de l\'équipe',
    ],
    
    'history' => [
        'title' => 'Historique des réponses',
        'no_responses' => 'Aucune réponse pour le moment',
        'staff_response' => 'Équipe',
        'user_response' => 'Utilisateur',
        'internal_note' => 'Interne',
    ],
];
